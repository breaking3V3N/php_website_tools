//https://developer.mozilla.org/en-US/docs/Web/API/WebRTC_API/build_a_phone_with_peerjs/connect_peers/get_microphone_permission

/*

/*
Accesses and Displays webcam. Need to do:
    (1) CSS
    (2) Close Webcam
    (3) Call function
*/




function getAudioStream(){
    navigator.mediaDevices.getUserMedia({audio: true}).then(stream =>
    {window.localStream = stream;
    window.localAudio.srcObject = stream;
    window.localAudio.autoplay = true;
    }).catch( err0r => {
        console.log("Error:" + err0r)
    });
}