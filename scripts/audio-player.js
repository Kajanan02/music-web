//let now_playing = document.querySelector(".now-playing");
let track_art = document.querySelector(".track-art");
let track_name = document.querySelector(".track-name");
let track_artist = document.querySelector(".track-artist");

let playpause_btn = document.querySelector(".play-pause-track");
let prev_btn = document.querySelector(".prev-track");
let next_btn = document.querySelector(".next-track");

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
        name: "Aaruyirae",
        artist: "A.R. Rahman",
        image: "assets/album-art/Guru.jpg",
        path: "assets/audio/Aaruyirae.mp3"
    },
    {
        name: "Bekhayali",
        artist: "Kabir Singh",
        image: "assets/album-art/audio.jpeg",
        path: "assets/audio/Bekhayali.mp3"
    },
    {
        name: "Castle on the Hill",
        artist: "Ed Sheeran",
        image: "assets/album-art/Divide.png",
        path: "assets/audio/Castle On The Hill.mp3"
    },
    {
        name: "Dura",
        artist: "Daddy Yankee",
        image: "assets/album-art/Daddy-K-The-Mix-12.jpg",
        path: "assets/audio/Dura.mp3"
    },
    {
        name: "Goodlife",
        artist: "Kehlani ft. G-Eazy",
        image: "assets/album-art/The_Fate_of_the_Furious_The_Album.jpg",
        path: "assets/audio/Goodlife (ft. G-Eazy).mp3"
    },
    {
        name: "Hall of Fame",
        artist: "The Script",
        image: "assets/album-art/3.jpg",
        path: "assets/audio/Hall Of Fame.mp3"
    },
    {
        name: "Perfect",
        artist: "Ed Sheeran",
        image: "assets/album-art/Divide.png",
        path: "assets/audio/Perfect.mp3"
    },
    {
        name: "Unconditionally",
        artist: "Katy Perry",
        image: "assets/album-art/Prism.jpg",
        path: "assets/audio/Unconditionally.mp3"
    },
  ];

function loadTrack(track_index){
    clearInterval(updateTimer);
    resetValues();

    curr_track.src = track_list[track_index].path;
    curr_track.load();

    track_art.style.backgroundImage = "url(" + track_list[track_index].image + ")";
    track_name.textContent = track_list[track_index].name;
    track_artist.textContent = track_list[track_index].artist;
    //now_playing.textContent = "PLAYING " + (track_index + 1) + " OF " + track_list.length;

    updateTimer = setInterval(seekUpdate, 1000); //// Set an interval of 1000 milliseconds for updating the seek slider
    curr_track.addEventListener("ended", nextTrack);
}

function resetValues(){
    curr_time.textContent = "00:00";
    total_duration.textContent = "00:00";
    //seek_slider.value = 0;
}

loadTrack(track_index);

function playPauseTrack(){
    if(!isPlaying) playTrack();
    else pauseTrack();
}

function playTrack(){
    curr_track.play();
    isPlaying = true;

    playpause_btn.innerHTML = "<i class='fa fa-pause-circle fa-5x'></i>";
}

function pauseTrack(){
    curr_track.pause();
    isPlaying = false;

    playpause_btn.innerHTML = "<i class='fa fa-play-circle fa-5x'></i>";
}

function nextTrack(){
    if(track_index < track_list.length - 1){
        track_index += 1;
    }
    else track_index = 0;

    loadTrack(track_index);
    playTrack();
}

function prevTrack(){
    if(track_index > 0){
        track_index -= 1;
    }
    else track_index = track_list.length - 1;

    loadTrack(track_index);
    playTrack();
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

function viewLyrics(){
    let isEnabled = document.getElementById("lyrics").checked;
    if(isEnabled){
        console.log(isEnabled);
    }
    else{
        console.log(isEnabled);
    }
}

viewLyrics();