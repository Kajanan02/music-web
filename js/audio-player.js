let track_art = document.querySelector(".track-art");
let track_name = document.querySelector(".track-name");
let track_artist = document.querySelector(".track-artist");

let playpause_btn = document.querySelector(".play-pause-track");
let prev_btn = document.querySelector(".prev-track");
let next_btn = document.querySelector(".next-track");
let playlistPlayBtn = document.querySelector(".play"); //should select the last clicked element: NEEDS FIXING

let seek_slider = document.querySelector(".seek-slider");
let volume_slider = document.querySelector(".volume-slider");
let curr_time = document.querySelector(".current-time");
let total_duration = document.querySelector(".total-duration");

let track_index = 0;
let isPlaying = false;
let updateTimer;
const NUMBER_OF_BARS = 150; // No of bars in the visualizer

let curr_track = document.createElement('audio');

let track_list=[];

function playSong(track_name, artist_name, album_art, profile_pic, audio_path, lyrics_path){
    track_list = [];

    let array = {
        name: track_name,
        artist: artist_name,
        image: album_art,
        artistArt: profile_pic,
        path: audio_path,
        lyrics: lyrics_path
    };
    track_list.push(array);

    loadTrack(track_index);
    playPauseTrack();
}

function playCollection(album_id){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var obj = JSON.parse(this.responseText);

            for(i=0; i<obj.length; i++){
                    var array = {
                        name: obj[i][0],
                        artist: obj[i][1],
                        image: "./"+obj[i][2],
                        artistArt: "./"+obj[i][3],
                        path: "./"+obj[i][4],
                        lyrics: "./"+obj[i][5]
                    };
                track_list.push(array);
                console.log(obj[i]);
            }
            
            loadTrack(track_index);
            playPauseTrack();
        }
    }
    xhr.open("GET", "./scripts/process-album.php?now_playing_album="+album_id);
    xhr.send();
}

function setTrackIndex(n){
    if(track_index == n){
        playPauseTrack();
    }
    else{
        track_index = n;
        loadTrack(n);
    }
}

function loadTrack(track_index){
    clearInterval(updateTimer);
    resetValues();

    curr_track.src = track_list[track_index].path;
    curr_track.load();

    showLyrics();

    track_art.style.backgroundImage = "url(" + track_list[track_index].image + ")";
    track_name.textContent = track_list[track_index].name;
    track_artist.textContent = track_list[track_index].artist;

    updateTimer = setInterval(seekUpdate, 500); //// Set an interval of 1000 milliseconds for updating the seek slider
    curr_track.addEventListener("ended", nextTrack);
}

function resetValues(){
    curr_time.textContent = "00:00";
    total_duration.textContent = "00:00";
    seek_slider.value = 0;
}

function playPauseTrack(){
    if(!isPlaying) playTrack();
    else pauseTrack();
}

function playTrack(){
    curr_track.setAttribute("autoplay","");
    curr_track.play();
    isPlaying = true;

    playpause_btn.innerHTML = "<i class='fa fa-pause-circle fa-5x'></i>";
    playlistPlayBtn.innerHTML = "<span class='fa fa-pause'></span>"
}

function pauseTrack(){
    
    curr_track.pause();
    curr_track.removeAttribute("autoplay");
    isPlaying = false;

    playpause_btn.innerHTML = "<i class='fa fa-play-circle fa-5x'></i>";
    playlistPlayBtn.innerHTML = "<span class='fa fa-play'></span>"
}

function nextTrack(){
    if(track_index < track_list.length - 1){
        track_index += 1;
    }
    else track_index = 0;

    loadTrack(track_index);
    playTrack();
    viewLyricsPanel();
    viewVisualizer();
}

function prevTrack(){
    if(track_index > 0){
        track_index -= 1;
    }
    else track_index = track_list.length - 1;

    loadTrack(track_index);
    playTrack();
    viewLyricsPanel();
    viewVisualizer();
}

function seekTo(){
    let seekto = curr_track.duration * (seek_slider.value / 100);
    curr_track.currentTime = seekto;
}

function setVolume(){
    curr_track.volume = volume_slider.value/100;
}

function seekUpdate(){
    let seekPosition = 0;

    if(!isNaN(curr_track.duration)){
        seekPosition = curr_track.currentTime * (100 / curr_track.duration);
        seek_slider.value = seekPosition;

        let currentMinutes = Math.floor(curr_track.currentTime/60);
        let currentSeconds = Math.floor(curr_track.currentTime - currentMinutes*60);
        let durationMinutes = Math.floor(curr_track.duration/60);
        let durationSeconds = Math.floor(curr_track.duration - durationMinutes*60);

        if(currentSeconds < 10) currentSeconds = "0" + currentSeconds;
        if(durationSeconds < 10) durationSeconds = "0" + durationSeconds;
        if(currentMinutes < 10) currentMinutes = "0" + currentMinutes;
        if(durationMinutes < 10) durationMinutes = "0" + durationMinutes;

        curr_time.textContent = currentMinutes + ":" + currentSeconds;
        total_duration.textContent = durationMinutes + ":" + durationSeconds;
    }
}

function viewLyricsPanel(){
    let isEnabled = document.getElementById("lyrics-switch").checked;
    if(isEnabled){
        document.getElementById("visualizer-switch").checked = false;
        hidebars();

        document.getElementById("lyric").innerHTML = "";
        document.getElementById("background-panel").style.backgroundColor = "rgb(74, 71, 71)";
        document.getElementById("background-panel").style.display = "block";
        document.getElementById("lyrics-panel").style.backgroundImage = "url(" + track_list[track_index].artistArt + ")";
        document.getElementById("lyrics-panel").style.display = "block";
    }
    else{
        document.getElementById("background-panel").style.display = "none";
        document.getElementById("lyrics-panel").style.display = "none";
    }
}

async function showLyrics() {
    "use strict";
    
    let lrcFile = track_list[track_index].lyrics;
    let audioFile = track_list[track_index].path;
    
    const dom = {
        lyric: document.getElementById("lyric"),
        player: curr_track
    };

    const result = await fetch(lrcFile);
    const lrc = await result.text();
    
    let lyrics = parseLyrics(lrc);

    dom.player.src = audioFile;

    dom.player.ontimeupdate = () => {
        const time = dom.player.currentTime;
        const index = syncLyrics(lyrics, time);

        if (index == null) return;

        dom.lyric.innerHTML = lyrics[index].text;
    };
};

function parseLyrics(lrc) {
    let regEx = /(\d{2}:\d{2}.\d{2}).([a-zA-Z ',]+)/i;

    const lines = lrc.split("\n");

    const output = [];

    lines.forEach(line => {
        let match = line.match(regEx);
        
        if (match == null) return;
        
        output.push({
            time: parseTime(match[1]),
            text: match[2].trim()
        });
    });

    // TIMESTAMP FORMAT - mm:ss:xx (minutes: seconds: xx-100ths of a second)
    function parseTime(time) {
        const minsec = time.split(":");
        const min = parseInt(minsec[0]) * 60; // convert minutes to seconds
        const sec = parseFloat(minsec[1]);

        return min + sec; // return total time in seconds
    }

    return output;
}

function syncLyrics(lyrics, time) {
    const scores = [];

    lyrics.forEach(lyric => {
        const score = time - lyric.time; // get the gap or distance
        if (score >= 0) scores.push(score);
    });

    if (scores.length == 0) return null;

    const closest = Math.min(...scores); // get the smallest value from scores

    return scores.indexOf(closest); // return the index of closest lyric
}

function viewVisualizer(){
    let isEnabled = document.getElementById("visualizer-switch").checked;
    if(isEnabled){
        document.getElementById("lyrics-switch").checked = false;
        document.getElementById("lyrics-panel").style.display = "none";

        document.getElementById("background-panel").style.backgroundColor = "rgb(0,0,0,1)";
        showbars();
        document.getElementById("background-panel").style.display = "block";
        visualizeAudio();
    }
    else{
        document.getElementById("background-panel").style.display = "none";
        hidebars();
    }
}

function visualizeAudio(){
    const audio = curr_track;
    const audioContext = new AudioContext();
    const audioSource = audioContext.createMediaElementSource(audio);
    
    const analyzer = audioContext.createAnalyser();
    audioSource.connect(analyzer); //Connect Audio to Analyzer
    audioSource.connect(audioContext.destination); //Connect Audio to Context

    const frequencyData = new Uint8Array(analyzer.frequencyBinCount);
    analyzer.getByteFrequencyData(frequencyData);
    console.log("frequencyData", frequencyData);

    const visualizerContainer = document.getElementById("background-panel");

    // Creating pre-defined bars
    for(let i=0; i<NUMBER_OF_BARS; i++){
        const bar = document.createElement("div");
        bar.setAttribute("id", "bar" + i);
        bar.setAttribute("class", "visualizer-container__bar");
        visualizerContainer.appendChild(bar);
    }

    function renderFrame(){
        analyzer.getByteFrequencyData(frequencyData);

        for(let i=0; i<NUMBER_OF_BARS; i++){
            // length of frequencyData array = 1024
            const index = (i+10)*2;
            const fd = frequencyData[index]; // fd = value between 0-255
            const bar = document.querySelector("#bar" + i);
            
            if(!bar) continue;
    
            // if fd = undefined --> set fd to 0
            // fd is at least 4px high for visual effects
            const barHeight = Math.max(4, fd || 0);
            bar.style.height = barHeight + "px";
        }
        window.requestAnimationFrame(renderFrame);
    }

    renderFrame();
}

function hidebars(){
    console.log(document.getElementById("bar0"));
    if(document.getElementById("bar0") != null){
        for(let i=0; i<NUMBER_OF_BARS; i++){
            document.getElementById("bar"+i).style.display = "none";
        }
    }
}

function showbars(){
    if(document.getElementById("bar0") != null){
        for(let i=0; i<NUMBER_OF_BARS; i++){
            document.getElementById("bar"+i).style.display = "inline-block";
        }
    }    
}