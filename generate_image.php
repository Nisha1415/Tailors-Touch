<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Female Try-On</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three/examples/js/loaders/GLTFLoader.js"></script>
    <style>
        body { text-align: center; }
        canvas { display: block; margin: auto; }
        .controls { margin: 20px; }
        #viewer { width: 500px; height: 500px; margin: auto; } /* Fixed viewer size */
    </style>
</head>
<body>
    <h1>Virtual Try-On (Female Model)</h1>
    <button id="tryThis">Try This</button>
    <div class="controls">
        <label>Height: <input type="range" id="height" min="150" max="200" value="170"></label>
        <label>Waist: <input type="range" id="waist" min="60" max="120" value="80"></label>
        <label>Chest: <input type="range" id="chest" min="70" max="130" value="90"></label>
    </div>
    <div id="viewer"></div>

    <script>
        let scene, camera, renderer, model, bodyMesh;
        const loader = new THREE.GLTFLoader();
        let modelLoaded = false;

        function init3D() {
            if (modelLoaded) return;

            scene = new THREE.Scene();
            scene.background = new THREE.Color(0xeeeeee);

            camera = new THREE.PerspectiveCamera(75, 500 / 500, 0.1, 1000);
            camera.position.z = 3;

            renderer = new THREE.WebGLRenderer({ alpha: true });
            renderer.setSize(500, 500);
            document.getElementById('viewer').appendChild(renderer.domElement);

            const modelUrl = 'http://localhost/TailorsTouch/images/female_body.glb';


            loader.load(modelUrl, function(gltf) {
                model = gltf.scene;
                model.scale.set(1.5, 1.5, 1.5); // Adjust model scale

                model.traverse(function(child) {
                    if (child.isMesh) {
                        let material = new THREE.MeshStandardMaterial({ color: 0xC0C0C0, metalness: 0, roughness: 1 });

                        if (child.name.toLowerCase().includes("body")) { // Adjust naming based on your model
                            bodyMesh = child;
                            child.material = material;
                        } else if (child.name.toLowerCase().includes("shirt")) {
                            child.material = new THREE.MeshStandardMaterial({ color: 0xff0000 });
                        } else if (child.name.toLowerCase().includes("pants")) {
                            child.material = new THREE.MeshStandardMaterial({ color: 0x0000ff });
                        }
                    }
                });

                scene.add(model);
                animate();
                modelLoaded = true;
            }, undefined, function(error) {
                console.error('Error loading model:', error);
            });
        }

        function animate() {
            requestAnimationFrame(animate);
            renderer.render(scene, camera);
        }

        document.getElementById('tryThis').addEventListener('click', init3D);

        function updateSize() {
            if (!model || !bodyMesh) return;

            let height = document.getElementById('height').value / 170;
            let waist = document.getElementById('waist').value / 80;
            let chest = document.getElementById('chest').value / 90;

            bodyMesh.scale.set(chest, height, waist);
        }

        document.querySelectorAll('.controls input').forEach(input => {
            input.addEventListener('input', updateSize);
        });

        window.addEventListener('resize', () => {
            camera.aspect = 500 / 500;
            camera.updateProjectionMatrix();
            renderer.setSize(500, 500);
        });

    </script>
</body>
</html>
