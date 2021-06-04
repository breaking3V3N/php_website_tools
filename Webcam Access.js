/*
Accesses and Displays webcam. Need to do:
    (1) CSS
    (2) Close Webcam
    (3) Call function
*/

function get_video_permission(){
    var video = document.querySelector("#VideoElement");
    if(navigator.mediaDevices.getUserMedia)
    {
        navigator.mediaDevices.getUserMedia({video: true})
        .then(function(stream) { 
            video.srcObject = stream;
            video.onloadedmetadata = (e) => {
        video.play();
    };
    })
    .catch(function(err0r){
        console.log("Something went wrong");
    
    });
    }
}

