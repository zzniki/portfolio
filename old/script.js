var content = document.getElementById("content");
var btnAbout = document.getElementById("btn-about");
var btnProjects = document.getElementById("btn-projects");

var stars = []
var sineProgress = 0;
var pageAnimToggle = false;
var pageAnimPhase = 0;
var pageAnimTimer = 0;
var rocketVel = 0;
var fadeOpacity = 0;
var pageTarget = "";
var doRedirect = false;

// UTILITY FUNCTIONS

function randInt(min, max) {
  return Math.floor(Math.random() * (max - min) ) + min;
}

// SETUP

const scene = new THREE.Scene();

const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);

const renderer = new THREE.WebGLRenderer({
  
  antialias: true,
  
});

document.body.appendChild(renderer.domElement);

renderer.setPixelRatio(window.devicePixelRatio);
renderer.setSize(window.innerWidth, window.innerHeight);

camera.position.setZ(30);

renderer.render(scene, camera);

var clock = new THREE.Clock();

// OBJECT CREATION

const gltfLoader = new THREE.GLTFLoader();
const textureLoader = new THREE.TextureLoader();

// -- earth

earthNormal = textureLoader.load("assets/normal.jpg");
earthTexture = textureLoader.load("assets/texture.jpg", (texture) => { stopLoader(); });
  
const gEarth = new THREE.SphereGeometry(15, 64, 32);
const mEarth = new THREE.MeshStandardMaterial({
  
  map: earthTexture,
  normalMap: earthNormal

});

const earth = new THREE.Mesh(gEarth, mEarth);

scene.add(earth);

// -- rocket

var rocket = null;

gltfLoader.load("assets/Rocketship.glb", function(gltf) {

  rocket = gltf.scene;

  rocket.position.set(0, -145, 0);
  rocket.scale.multiplyScalar(1.25);

  scene.add(rocket);

  const rocketLight = new THREE.SpotLight(0xFFFFFF, 15);

  rocketLight.position.set(0, -135, 40);
  rocketLight.target = rocket;
  rocketLight.castShadow = true;
  rocketLight.distance = 50;

  scene.add(rocketLight);

});

// -- asteroids

var asteroids = null;

gltfLoader.load("assets/Asteroid.glb", function(gltf) {

  asteroids = gltf.scene;

  asteroids.position.set(-5, -120, 5);
  asteroids.scale.multiplyScalar(5);

  scene.add(asteroids);

});

// -- stars

var firstStar = true;

for (var i = 0; i < 300; i++) {
  
  const gNewStar = new THREE.SphereGeometry(2, 24, 12);
  const mNewStar = new THREE.MeshStandardMaterial({
    
    color: 0xFFFFFF
    
  });
  
  const newStar = new THREE.Mesh(gNewStar, mNewStar);
  
  var randX = randInt(-1000, 1000);
  var randY = randInt(-1000, 1000);
  var randZ = randInt(-400, -500);
  
  if (firstStar) {
    
    newStar.position.set(0, 0, -400);
    firstStar = false;
    
  } else {
  
    newStar.position.set(randX, randY, randZ);
    
  }
  
  stars.push(newStar);
  
  scene.add(newStar);
  
}

// -- lights

const sunLight = new THREE.DirectionalLight(0xFFFFFF, 2);

sunLight.position.set(20, 10, 10);
sunLight.target = earth;

scene.add(sunLight);

const moonLight = new THREE.DirectionalLight(0xFFFFFF, 0.1);

moonLight.position.set(-20, -10, -10);
moonLight.target = earth;

scene.add(moonLight);

const starLight = new THREE.SpotLight(0xFFFFFF, 100);

starLight.position.set(0, 0, -100);
starLight.target = stars[0];

starLight.castShadow = false;

scene.add(starLight);


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
  
  earth.rotation.y += 0.1 * deltaTime;
  sineProgress += deltaTime * 2;
  
  var sinResult = Math.sin(sineProgress) * 5;
  var sinResult2 = Math.sin(sineProgress + 5);
  
  btnAbout.style.transform = "translateY(" + sinResult + "px)";
  btnProjects.style.transform = "translateY(" + sinResult + "px)";

  if (rocket != null && !pageAnimToggle) {

    rocket.rotation.y += sinResult2 * .0015;
    rocket.position.y += sinResult * .005;

  }

  if (asteroids != null) {

    asteroids.rotation.y += sinResult * .00001;
    asteroids.position.y += sinResult2 * .001;

  }

  if (rocket != null && pageAnimToggle) {

    rocket.position.y += rocketVel * deltaTime
    if (rocketVel < 0) rocketVel += 30 * deltaTime

    if (pageAnimPhase == 0 && rocketVel >= 0) {
      pageAnimPhase = 1;
      rocketVel = 100;

      pageAnimTimer = new Date().getTime();

    }

    //rocket.position.y += 30 * deltaTime;
    
    if (pageAnimPhase == 1) {

      var timer = new Date().getTime() - pageAnimTimer;
      if (timer >= 1000 && !doRedirect) {

        doRedirect = true;
        if (pageTarget == "projects") fadeOut("/projects");
          else if (pageTarget == "about") fadeOut("/about");

      }

    }

  }
  
  renderer.render(scene, camera);
  
}

content.onscroll = function() {
  
  var distance = content.scrollTop;
  
  camera.position.setY(-(distance / 13));
  
}

function scrollDown() {
  
  document.getElementById("bottom").scrollIntoView({behavior: "smooth"});
  
}

function pageAnim(target) {
  
  pageAnimToggle = true;
  pageAnimTimer = new Date().getTime();
  rocketVel = -30;
  pageTarget = target;

}

onUpdate();