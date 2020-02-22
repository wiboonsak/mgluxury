<!DOCTYPE html>
<html lang="en">
	<head>
		<title>360 VIEW</title>
		<meta charset="utf-8">
		


<style>

*{margin:0;padding:0;}

body{
  
  
  width:100%;
  height:100%;
   margin: 0; overflow: hidden; background-color: #000; 
  

}



                        

</style>

          

  
</head>                  

<body>
   <?php $img = $this->uri->segment(3);?>
    
       <div id="sence">
       </div>
      
   
  
</body>


    <script src="<?php echo base_url('assets/js/three.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/OrbitControls.js')?>"></script>	
	<script src="<?php echo base_url('assets/js/Detector.js')?>"></script>		
	<script>

		var webglEl = document.getElementById('sence');

		var width  = window.innerWidth,
			height = window.innerHeight;

		var scene = new THREE.Scene();

		var camera = new THREE.PerspectiveCamera(75, width / height, 1, 1000);
		camera.position.x = 0.1;

		var renderer = Detector.webgl ? new THREE.WebGLRenderer() : new THREE.CanvasRenderer();
		renderer.setSize(width, height);

		var sphere = new THREE.Mesh(
			new THREE.SphereGeometry(100, 20, 20),
			new THREE.MeshBasicMaterial({
				map: THREE.ImageUtils.loadTexture("<?php echo base_url('uploadfile/360view/'.$img)?>")
			})
		);
		sphere.scale.x = -1;
		scene.add(sphere);

		var controls = new THREE.OrbitControls(camera);
		controls.noPan = true;
		controls.noZoom = true; 
		controls.autoRotate = true;
		controls.autoRotateSpeed = 0.5;
		//controls.rotateLeft(3);
		controls.rotateUp(.5);

		webglEl.appendChild(renderer.domElement);

		render();

		function render() {
			controls.update();
			requestAnimationFrame(render);
			renderer.render(scene, camera);
		}

		function onMouseWheel(event) {
			event.preventDefault();
			
			if (event.wheelDeltaY) { // WebKit
				camera.fov -= event.wheelDeltaY * 0.05;
			} else if (event.wheelDelta) { 	// Opera / IE9
				camera.fov -= event.wheelDelta * 0.05;
			} else if (event.detail) { // Firefox
				camera.fov += event.detail * 1.0;
			}

			camera.fov = Math.max(40, Math.min(100, camera.fov));
			camera.updateProjectionMatrix();
		}

		document.addEventListener('mousewheel', onMouseWheel, false);
		document.addEventListener('DOMMouseScroll', onMouseWheel, false);

	</script>
    
</html>
    