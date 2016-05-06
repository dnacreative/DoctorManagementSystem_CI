<div class="col-lg-12 pull-left" >
    <div class="col-lg-6">
        <h2><?=$title?> Doctors</h2>
    </div>
    <div class="col-lg-6">
        <a href="<?= base_url('admin_dev/doctor/add')?>" class="pull-right btn btn-success add-doctor-btn" >Add Doctor</a>
    </div>
</div>

<div class="col-lg-12 pull-left">
<table id="doctors_table" class="display" cellspacing="0" width="100%" data-id="<?php echo($doctors_param);?>">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Desription</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>    
        <tbody>
                 
        <?php foreach ($doctors as $doctor){?>
            <tr>
                <td><img class='doctor-img' src="<?=$doctor['img']?>" alt="<?=$doctor['name']?>"></td>
                <td><?=$doctor['name']?></td>
                <td><p class='doctor-bio'><?=$doctor['bio']?></p></td>
                <td><?=$doctor['address']?></td>
                <td>
                    <p>
                        <a href="<?=base_url('admin_dev/doctor/edit/'.$doctor['id'])?>" class="btn btn-info" role="button">Edit</a>
                        <a href="<?=base_url('admin_dev/doctor/del/'.$doctor['id'])?>" class="btn btn-danger del" role="button">Delete</a>
                    </p>
                </td>
            </tr>
        
        <?php }?>
        
    
    </tbody>

</table>
</div>
<!--
<?=$pagination?>
-->
