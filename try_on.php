<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Blouse Shoulder Alignment</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #fceff9, #f4fdfb);
      margin: 0;
      padding: 40px 20px;
      color: #333;
      animation: fadeInBody 1s ease-in;
    }

    @keyframes fadeInBody {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .container {
      max-width: 1000px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
      animation: fadeInContainer 0.8s ease-in-out;
    }

    @keyframes fadeInContainer {
      from { opacity: 0; transform: scale(0.98); }
      to { opacity: 1; transform: scale(1); }
    }

    h2 {
      margin-bottom: 20px;
      font-size: 28px;
      color: #444;
      font-weight: 600;
      animation: fadeInText 1s ease-in;
    }

    @keyframes fadeInText {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .flex-view {
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
    }

    video, canvas {
      border: 3px dashed #ff7b9c;
      border-radius: 12px;
      max-width: 480px;
      width: 100%;
      height: auto;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      transition: border 0.3s ease, transform 0.3s ease;
    }

    canvas:hover {
      border-color: #ff3b7f;
      transform: scale(1.02);
    }

    button {
      margin: 20px 10px 0;
      padding: 12px 24px;
      font-size: 16px;
      background: #ff6b81;
      color: white;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
    }

    button:hover {
      background: #e74c3c;
      transform: scale(1.05);
    }

    .controls {
      margin-top: 20px;
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 15px;
    }

    label {
      font-weight: 500;
    }

    select {
      padding: 8px 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
  <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/body-pix"></script>
</head>
<body>
  <div class="container">
    <h2>Align Blouse with Shoulder</h2>
    
    <div class="flex-view">
      <video id="video" autoplay playsinline width="480" height="360" style="display:none;"></video>
      <canvas id="canvas" width="480" height="360"></canvas>
    </div>

    <div class="controls">
      <label for="dressTypeSelect">Dress Type:</label>
      <select id="dressTypeSelect">
        <option value="blouse">Blouse</option>
        <option value="kurtha">Kurtha</option>
        <option value="frock">Frock</option>
        <option value="skirt">Skirt</option>
      </select>

      <label for="colorDropdown">Dress Color:</label>
      <select id="colorDropdown">
        <option value="red">Red</option>
        <option value="blue">Blue</option>
        <option value="cream">Cream</option>
        <option value="green">Green</option>
        <option value="yellow">Yellow</option>
        <option value="peach">Peach</option>
        <option value="purple">Purple</option>
        <option value="black">Black</option>
        <option value="white">White</option>
        <option value="pink">Pink</option>
        <option value="maroon">Maroon</option>
      </select>
    </div>
    
    <br />
    <button onclick="startCamera()">Start Camera</button>
    <button onclick="capture()">Detect & Align</button>
  </div>

  <script>
  const video = document.getElementById('video');
  const canvas = document.getElementById('canvas');
  const ctx = canvas.getContext('2d');
  let model;

  async function loadModel() {
    model = await bodyPix.load();
    console.log("Model Loaded");
  }
  loadModel();

  function startCamera() {
    navigator.mediaDevices.getUserMedia({ video: true })
      .then(stream => {
        video.srcObject = stream;
        video.style.display = 'block';
      })
      .catch(err => alert("Camera error: " + err));
  }

  async function capture() {
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    const segmentation = await model.segmentPersonParts(video, {
      internalResolution: 'medium',
      segmentationThreshold: 0.7,
      maxDetections: 1
    });

    const pose = segmentation.allPoses?.[0];
    if (!pose) return alert("No pose detected");

    const leftShoulder = pose.keypoints.find(k => k.part === 'leftShoulder');
    const rightShoulder = pose.keypoints.find(k => k.part === 'rightShoulder');
    const leftEar = pose.keypoints.find(k => k.part === 'leftEar');
    const rightEar = pose.keypoints.find(k => k.part === 'rightEar');

    if (!leftShoulder || !rightShoulder || leftShoulder.score < 0.5 || rightShoulder.score < 0.5) {
      alert("Shoulders not clearly visible");
      return;
    }

    drawPoint(leftShoulder.position, 'red');
    drawPoint(rightShoulder.position, 'red');

    const shoulderWidth = Math.hypot(
      rightShoulder.position.x - leftShoulder.position.x,
      rightShoulder.position.y - leftShoulder.position.y
    );
    const shoulderCenterX = (leftShoulder.position.x + rightShoulder.position.x) / 2;
    const shoulderCenterY = (leftShoulder.position.y + rightShoulder.position.y) / 2;

    let neckYBase;
    if (leftEar && rightEar && leftEar.score > 0.5 && rightEar.score > 0.5) {
      neckYBase = (leftEar.position.y + rightEar.position.y) / 2 + (shoulderWidth * 0.1);
    } else {
      neckYBase = shoulderCenterY - (shoulderWidth * 0.35);
    }

    const neckX = shoulderCenterX;
    drawPoint({ x: neckX, y: neckYBase }, 'blue');

    const dressType = document.getElementById('dressTypeSelect').value;
    const dressColor = document.getElementById('colorDropdown').value.toLowerCase();

    const dressImg = new Image();
    dressImg.onload = () => {
  let scaleFactor, newWidth, newHeight, dx, dy;

  if (dressType === 'blouse') {
    scaleFactor = shoulderWidth / dressImg.width * 1.6;
    newWidth = dressImg.width * scaleFactor;
    newHeight = dressImg.height * scaleFactor;
    dx = neckX - newWidth / 2;
    dy = neckYBase - newHeight * 0.05;

  } else if (dressType === 'kurtha') {
    const torsoLength = canvas.height * 0.55;
    const desiredKurthaHeight = torsoLength;
    scaleFactor = desiredKurthaHeight / dressImg.height;

    newWidth = dressImg.width * scaleFactor;
    newHeight = dressImg.height * scaleFactor;
    dx = shoulderCenterX - newWidth / 2;
    dy = shoulderCenterY - newHeight * 0.1;

  } else if (dressType === 'frock') {
    const frockLength = canvas.height * 0.7;  // Extended more than kurtha
          scaleFactor = frockLength / dressImg.height;
          newWidth = dressImg.width * scaleFactor;
          newHeight = dressImg.height * scaleFactor;
          dx = shoulderCenterX - newWidth / 2;
          dy = shoulderCenterY - newHeight * 0.1;

  } else if (dressType === 'skirt') {
    const skirtLength = canvas.height * 0.5; // from waist to just above knee
    scaleFactor = skirtLength / dressImg.height;

    newWidth = dressImg.width * scaleFactor;
    newHeight = dressImg.height * scaleFactor;

    const waistY = shoulderCenterY + (canvas.height * 0.2); // estimated waistline
    dx = shoulderCenterX - newWidth / 2;
    dy = waistY;

  } else {
    alert("Unsupported dress type.");
    return;
  }

  ctx.globalAlpha = 0.97;
  ctx.drawImage(dressImg, dx, dy, newWidth, newHeight);
  ctx.globalAlpha = 1.0;
};


    dressImg.onerror = () => alert(`Image not found: ${dressType}_${dressColor}.png`);
    dressImg.src = `images/${dressType}_${dressColor}.png`;
  }

  function drawPoint(p, color) {
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.arc(p.x, p.y, 5, 0, 2 * Math.PI);
    ctx.fill();
  }
</script>

</body>
</html>
