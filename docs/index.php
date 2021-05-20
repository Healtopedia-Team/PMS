<html>
    <head>
        <title>Instascan &ndash; Demo</title>
        <link rel="icon" type="image/png" href="favicon.png">
        <link rel="stylesheet" href="style.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
        <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    </head>
    <body>
        <div id="app">
            <div class="sidebar">
                <section class="cameras">
                    <h2>Cameras</h2>
                    <ul>
                        <li v-if="cameras.length === 0" class="empty">No cameras found</li>
                        <li v-for="camera in cameras">
                            <span v-if="camera.id == activeCameraId" :title="formatName(camera.name)" class="active">{{ formatName(camera.name) }}</span>
                            <span v-if="camera.id != activeCameraId" :title="formatName(camera.name)">
                                <a @click.stop="selectCamera(camera)">{{ formatName(camera.name) }}</a>
                            </span>
                        </li>
                    </ul>
                </section>
                <section class="scans">
                    <h2>Scans</h2>
                    <ul v-if="scans.length === 0">
                        <li class="empty">No scans yet</li>
                    </ul>
                    <transition-group name="scans" tag="ul">
                        <li v-for="scan in scans" :key="scan.date" :title="scan.content">{{ scan.content }}</li>
                    </transition-group>
                </section>
            </div>
            <div class="preview-container">
                <video id="preview"></video>
            </div>
        </div>
        <script type="text/javascript" src="app.js"></script>
    </body>
</html>
