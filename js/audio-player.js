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

let curr_track = document.createElement('audio');

let track_list = [
    {
        name: "Castle on the Hill",
        artist: "Ed Sheeran",
        image: "assets/album-art/Divide.png",
        artistArt: "assets/artist-art/Ed_Sheeran.jpg",
        path: "assets/audio/Castle On The Hill.mp3",
        lyrics: "assets/lrc/Castle-On-The-Hill.lrc"
    },
    {
        name: "Perfect",
        artist: "Ed Sheeran",
        image: "assets/album-art/Divide.png",
        artistArt: "assets/artist-art/Ed_Sheeran.jpg",
        path: "assets/audio/Perfect.mp3",
        lyrics: "assets/lrc/Perfect.lrc"
    },
    {
        name: "Dura",
        artist: "Daddy Yankee",
        image: "assets/album-art/Daddy-K-The-Mix-12.jpg",
        artistArt: "assets/artist-art/Daddy-Yankee.jpg",
        path: "assets/audio/Dura.mp3",
        lyrics: "assets/lrc/Dura.lrc"
    },
    {
        name: "Goodlife",
        artist: "Kehlani ft. G-Eazy",
        image: "assets/album-art/The_Fate_of_the_Furious_The_Album.jpg",
        artistArt: "",
        path: "assets/audio/Goodlife (ft. G-Eazy).mp3",
        lyrics: ""
    },
    {
        name: "Hall of Fame",
        artist: "The Script",
        image: "assets/album-art/3.jpg",
        artistArt: "",
        path: "assets/audio/Hall Of Fame.mp3",
        lyrics: ""
    },
    {
        name: "Unconditionally",
        artist: "Katy Perry",
        image: "assets/album-art/Prism.jpg",
        artistArt: "",
        path: "assets/audio/Unconditionally.mp3",
        lyrics: ""
    },
    {
        name: "Aaruyirae",
        artist: "A.R. Rahman",
        image: "assets/album-art/Guru.jpg",
        artistArt: "assets/artist-art/A.R.Rahman.jpeg",
        path: "assets/audio/Aaruyirae.mp3",
        lyrics: ""
    },
    {
        name: "Bekhayali",
        artist: "Kabir Singh",
        image: "assets/album-art/audio.jpeg",
        artistArt: "",
        path: "assets/audio/Bekhayali.mp3",
        lyrics: ""
    },
  ];

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

loadTrack(track_index);

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
    curr_track.play();
    isPlaying = true;

    playpause_btn.innerHTML = "<i class='fa fa-pause-circle fa-5x'></i>";
    playlistPlayBtn.innerHTML = "<span class='fa fa-pause'></span>"
}

function pauseTrack(){
    curr_track.pause();
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
}

function prevTrack(){
    if(track_index > 0){
        track_index -= 1;
    }
    else track_index = track_list.length - 1;

    loadTrack(track_index);
    playTrack();
    viewLyricsPanel();
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
        document.getElementById("lyric").innerHTML = "";
        document.getElementById("lyrics-panel-background").style.display = "block";
        document.getElementById("lyrics-panel").style.backgroundImage = "url(" + track_list[track_index].artistArt + ")";
        document.getElementById("lyrics-panel").style.display = "block";
    }
    else{
        document.getElementById("lyrics-panel-background").style.display = "none";
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