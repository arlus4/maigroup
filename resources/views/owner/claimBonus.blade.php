<!DOCTYPE html>
<html>
<head>
    <title>Claim Bonus</title>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<body>
    <video id="preview" width="100%"></video>
    <script type="text/javascript">
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
            console.log(content);
            // Kirim ke server
            // Contoh: 
            window.location.href =  content;
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });
    </script>
</body>
</html>