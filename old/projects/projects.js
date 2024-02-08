// PROJECT SETTINGS

var SENSITIVITY = 1.5;

// PROJECT VARS

const mouse = new THREE.Vector2();
const lastMouse = new THREE.Vector2();
const raycaster = new THREE.Raycaster();

var vel = 0;
var velDir = new THREE.Vector2();
var lastDiff = new THREE.Vector2();
var drag = 0.04;
var mouseClicked = false;

// SETUP

const scene = new THREE.Scene();

const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);

const renderer = new THREE.WebGLRenderer({
  
  antialias: true,
  alpha: true
  
});

document.body.appendChild(renderer.domElement);

renderer.setPixelRatio(window.devicePixelRatio);
renderer.setSize(window.innerWidth, window.innerHeight);

camera.position.setZ(80);

renderer.render(scene, camera);

var clock = new THREE.Clock();

// OBJECT CREATION

const gltfLoader = new THREE.GLTFLoader();
const textureLoader = new THREE.TextureLoader();

// -- moon

var moon = null;
var pivot = null;
var sunLight = new THREE.DirectionalLight(0xFFFFFF, 2);

gltfLoader.load("/assets/Moon.glb", (gltf) => {

    moon = gltf.scene;

    var cube_bbox = new THREE.Box3();
    cube_bbox.setFromObject(moon);
    cube_height = cube_bbox.max.y - cube_bbox.min.y;

    var centerPos = moon.position.y + cube_height / 2;

    camera.position.setY(centerPos);

    scene.add(moon);

    pivot = new THREE.Object3D();
    pivot.position.set(0, centerPos, 0);
    pivot.rotation.set(0, 0, 0);
    pivot.attach(moon);

    scene.add(pivot);

    sunLight.position.set(0, centerPos, 30);
    sunLight.target = pivot;

    scene.add(sunLight);

    stopLoader();

});

// SCENE LOOP

window.onresize = function() {
  
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize(window.innerWidth, window.innerHeight);
    
  }

function onUpdate() {
  
    requestAnimationFrame(onUpdate);
    
    deltaTime = clock.getDelta();

    raycaster.setFromCamera(mouse, camera);
    const intersects = raycaster.intersectObjects(scene.children);

    //console.log(intersects, mouse);

    for (let i = 0; i < intersects.length; i++) {
        console.log(intersects[i]);
    }

    // Apply velocity

    if (!mouseClicked) {

        var diff = new THREE.Vector2();
        diff.copy(velDir).multiplyScalar(vel).multiplyScalar(deltaTime);
        var rotResult = new THREE.Quaternion().setFromEuler(new THREE.Euler(-diff.y * SENSITIVITY, diff.x * SENSITIVITY, 0, "XYZ"));
        pivot.quaternion.multiplyQuaternions(rotResult, pivot.quaternion);

        if (vel > 0 && vel - drag > 0) vel -= drag;
        if (vel > 0 && vel - drag < 0) vel = 0;

        if (vel < 0 && vel + drag < 0) vel += drag;
        if (vel < 0 && vel + drag > 0) vel = 0;

    } else {

        vel = 0;
        velDir = new THREE.Vector2(0, 0);
    }
    
    // Render

    renderer.render(scene, camera);

}

function onMouseMove(event) {

    mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
    mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

    if (mouseClicked && lastMouse != new THREE.Vector2()) {

        const diff = new THREE.Vector2(mouse.x - lastMouse.x, mouse.y - lastMouse.y);
        lastDiff = diff;

        // Rotates the pivot :D (https://jsfiddle.net/MadLittleMods/n6u6asza/)
        var rotResult = new THREE.Quaternion().setFromEuler(new THREE.Euler(-diff.y * SENSITIVITY, diff.x * SENSITIVITY, 0, "XYZ"));
        pivot.quaternion.multiplyQuaternions(rotResult, pivot.quaternion);

    }

    lastMouse.x = mouse.x;
    lastMouse.y = mouse.y;

}

function mouseDown(event) {

    mouseClicked = true;
    vel = 0;
    velDir = new THREE.Vector2();
    lastDiff = new THREE.Vector2();

}

function mouseUp(event) {

    mouseClicked = false;

    velDir = new THREE.Vector2(lastDiff.x, lastDiff.y).normalize();
    vel = Math.sqrt(Math.abs(lastDiff.x), Math.abs(lastDiff.y)) * 7.5;

}

window.addEventListener("mousemove", onMouseMove);
window.addEventListener("mousedown", mouseDown);
window.addEventListener("mouseup", mouseUp);

onUpdate();