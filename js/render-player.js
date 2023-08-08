const audioPlayer = document.createElement("template");
audioPlayer.innerHTML = `
    <div id="background-panel"></div>
    <div id="lyrics-panel" class="self-align-center">
        <p id="lyric"></p>
    </div>
    
    <div class=" player m-0">
        <div class="row">
            <div class="col-12 seek-slider-container">
                <div class="slider-container">
                    <div class="current-time">00:00</div>
                    <input type="range" min="1" max="100" value="0" class="seek-slider" onchange="seekTo()"
                        style="width: 100%;">
                    <div class="total-duration">00:00</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="track-info-container-main">
                    <div class="track-art"></div>
                    <div class="track-info-container-sub">
                        <div class="track-name">Track Name</div>
                        <div class="track-artist">Track Artist</div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="playpause-container">
                    <div class="prev-track" onclick="prevTrack()">
                        <i class="fa fa-step-backward fa-3x"></i>
                    </div>
                    <div class="play-pause-track" onclick="playPauseTrack()">
                        <i class="fa fa-play-circle fa-4x"></i>
                    </div>
                    <div class="next-track" onclick="nextTrack()">
                        <i class="fa fa-step-forward fa-3x"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="right-main-container">
                    <div>
                        <div class="slider-container">
                            <i class="fa fa-volume-down"></i>
                            <input type="range" min="1" max="100" value="99" class="volume-slider"
                                onchange="setVolume()" style="margin: 10px;">
                            <i class="fa fa-volume-up"></i>
                        </div>
                    </div>
                    <div class="lyrics-visualizer-container">
                        <div style="margin-right: 20px;">
                            Lyrics: <label class="switch">
                                <input type="checkbox" id="lyrics-switch" onchange="viewLyricsPanel()">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div>
                            Visualizer: <label class="switch">
                                <input type="checkbox" id="visualizer-switch" onchange="viewVisualizer()">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row" style="margin-bottom: 15px;"></div>
    </div>`;

document.body.appendChild(audioPlayer.content);