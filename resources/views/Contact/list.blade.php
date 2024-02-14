@extends('layouts.mainlayout')
@section('content')

<div class = "container">

<?php if(session('error')) { ?>

<p style="color:red"><?php echo session('error'); ?></p>

<?php } ?>

<?php if(session('success')) { ?>

<div class="alert alert-success" role="alert"> 
  <p style="color:green"><?php echo session('success'); ?></p>
</div>

<?php } ?>
<?php  if(count($errors) > 0) { ?>

<?php foreach($errors->all() as $key => $val){ ?>

<div class="input-box">

<p style="color:red"><?php echo $val; ?></p>
</div>

<?php  } ?>

<?php } ?>

<?php if($data){?>

<h1>CONTACT LIST</h1>
<div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>IMAGE</th>
        <th>PHONE</th>
        <th>OPERATION</th>

      </tr>
    </thead>
    <tbody>
       
       <tr>
        
        <?php foreach($data as $key => $value){ 
      ?>
        <td><?php echo $value->id;?></td>
        <td><?php echo $value->name;?></td>
        <td><?php echo $value->email;?></td>
        <td><img style="width:85px;height:100px;" src="/images/<?php echo $value->image; ?>"/></td>
        <td><?php echo $value->phone;?></td>
        <td><a class="btn btn-danger" href="{{url ('delete',$value->id)}}">DELETE</a>
        <a class="btn btn-primary" href="{{url ('/contact/edit',$value->id)}}">EDIT</a></td>
     </tr>
    <?php } ?>

    </tbody>
  </table>
  
</div>

<?php } 

else { ?>

  <p> SORRY NO DATA ..</p>                                                                                      
           
    
<?php } ?>

</div>

<ul class="pagination">

   {{ $data->links() }}

</ul>

@endsection