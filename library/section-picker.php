<div class="colour-picker">


	<style>
		#colours li {
			list-style-type: none;
			display: block;
			float: left;
			width: 20%;
			height: 0;
			padding-bottom: 5%;
			padding-top: 15%;
			margin: 2%;
			cursor: pointer;

		}

		#colours li span {
			display: block;
			width: 100%;
			text-align: center;
			padding: 2% 2%;
		}
	</style>
	<ul id='colours'>

		<?php require_once( "get_colours.php" ); 

		foreach (get_colours() as $key => $value) {
				echo "<li data-color='" . $key . "' class='" . $key . "' style='background:" . $value["background"] . ";color:" . $value["text"] . "'><span>" . ucfirst($key) . "</span></li>";
		}
		
		?>

	</ul>

	<script>
		var lis = document.querySelectorAll('#colours li');

		var forEach = function (array, callback, scope) {
		  for (var i = 0; i < array.length; i++) {
		    callback.call(scope, i, array[i]); // passes back stuff we need
		  }
		};


		forEach(lis, function (index, li) {
		    
		    	li.addEventListener('click', function(e) {

					var return_text = '{{section:' + this.dataset.color + '}}';

					parent.tinyMCE.activeEditor.execCommand('mceInsertContent', 0, return_text);
					parent.tinyMCE.activeEditor.windowManager.close();

				});
		});
		


	</script>
</div>