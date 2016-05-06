<?php
    $base_url = $this->config->base_url();
    $public_url = $base_url.'public/';

    if($type == 'multiple') {
?>
		<div class="container" id="login_box">
			<form method="POST" action="<?php echo $base_url; ?>admin/UpdateAngles" enctype="multipart/form-data">
				<table id="table" class="tablesorter"> 
					<thead> 
						<tr> 
						    <th>Doctor</th> 
						    <th>Address</th> 
						    <th>Lon</th> 
						    <th>Lat</th> 
						    <th>Angle</th> 
						</tr> 
					</thead> 
				
					<tbody> 
<?php
		for($i=0;$i<count($doctors);$i++) {
?>
						<tr> 
						    <td><input type="hidden" name="id[]" value="<?php echo $doctors[$i]['id']; ?>" /> <?php echo $doctors[$i]['name']; ?></td> 
						    <td><a href="<?php echo $base_url.'doctors/'.$doctors[$i]['id']; ?>" target="_blank"><?php echo $doctors[$i]['address']; ?></a></td> 
						    <td><input type="text" name="lon[]" value="<?php echo $doctors[$i]['lon']; ?>" /></td> 
						    <td><input type="text" name="lat[]" value="<?php echo $doctors[$i]['lat']; ?>" /></td> 
						    <td><input type="text" name="angle[]" value="<?php echo $doctors[$i]['angle']; ?>" /></td> 
						</tr> 
<?php
		}
?>
					</tbody> 

					<button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
				</table>
			</form> 
<?php
	} else {
?>			
			<div id="admin_box" class="container">
				<h1>
					Admin Panel
				</h1>

				<form method="POST" action="<?php echo $base_url; ?>admin/UpdateDoctorProfile" enctype="multipart/form-data">
					<h1>
						<img src="<?php echo $base_url.$doctor['img']; ?>" width="200" class="thumbnail pull-left" alt="<?php echo $doctor['first']; ?>">
						<input type="text" name="first_name" class="form-control pull-left" value="<?php echo $doctor['first']; ?>">
						<input type="text" name="last_name" class="form-control pull-left" value="<?php echo $doctor['last']; ?>"><br>
						<input type="text" name="discoverable" class="form-control pull-left" value="<?php echo $doctor['disc']; ?>" style="width: 50px;"><br>
						<span class="clearfix"></span>
					</h1>

					<p style="border: solid 1px #ccc; padding: 10px;">
						Change Picture <input type="file" name="profile_pic">
					</p>

					<h2>
						Bio
					</h2>

					<p>
						<textarea type="text" name="bio" class="ckeditor"><?php echo $doctor['bio']; ?></textarea>
					</p>

					<h2>
						Location
					</h2>

					<ul class="list-group">
						<li class="list-group-item">Address: <input type="text" name="address" class="form-control" value="<?php echo $doctor['address']; ?>"></li>
						<li class="list-group-item">City: <input type="text" name="city" class="form-control" value="<?php echo $doctor['city']; ?>"></li>
						<li class="list-group-item">State: <input type="text" name="state" class="form-control" value="<?php echo $doctor['state']; ?>"></li>
						<li class="list-group-item">Longitude: <input type="text" name="lon" class="form-control" value="<?php echo $doctor['lon']; ?>"></li>
						<li class="list-group-item">Latitude: <input type="text" name="lat" class="form-control" value="<?php echo $doctor['lat']; ?>"></li>
					</ul>

					<!-- Display all of the doctor's info from other tables -->
<?php
		foreach($extra as $key) {
?>
					<h2>
						<?php echo ucwords($key); ?>

						<span class="pull-right"><i class="fa fa-plus-circle" id="<?php echo $key; ?>"></i></span>
						<span class="clearfix"></span>
					</h2>

					<div class="admin_load" id="<?php echo $key; ?>">
						<div class="ajax-loader">
							<i class="fa fa-circle-o-notch fa-3x fa-spin"></i>
						</div>
					</div>
<?php
		}
?>
					<div id="price_box">
<?php
		for($i=0;$i<$procedures['count'];$i++) {
?>
						<div class="striped">
							<div class="checkbox pull-left">
								<label>
									<input type="checkbox" name="specialties[]" value="<?php echo $procedures['data'][$i]['id']; ?>"><?php echo $procedures['data'][$i]['name']; ?>
								</label>
							</div>

							<div class="prices pull-left">
								<input class="form-control" type="text" name="prices[]" placeholder="Price">
							</div>

							<div class="clearfix"></div>
						</div>
<?php
		}
?>
					</div><br>
					
					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" id="doc_id" name="id" value="<?php echo $doctor['id']; ?>">
				</form>
			</div>

			<script src="//cdn.ckeditor.com/4.4.7/basic/ckeditor.js"></script>
<?php
	}
?>
		</div>