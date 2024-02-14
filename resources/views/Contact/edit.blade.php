@extends('layouts.mainlayout')
@section('content')

<div class="container">
  <h2>EDIT Contact</h2>
  
 <?php if(isset($error_msg)) { ?>

 <p style="color:red"><?php echo $error_msg; ?></p> 

<?php } ?>

<?php if(isset($success_msg)) { ?>

<div class="alert alert-success" role="alert"> 
  <p style="color:green"><?php echo $success_msg; ?></p>
</div>
<?php } ?>

<form action="/contact/edit" method="post" enctype="multipart/form-data">

<?php  if(count($errors) > 0) { ?>

<?php foreach($errors->all() as $key => $val){ ?>

<div class="alert alert-danger" role="alert"> 
 <p style="color:red"><?php echo $val; ?></p>
</div>

<?php  } ?>

<?php } ?>

  <div class="form-group">
      <input type="hidden" class="form-control" id="name" name="id" value="{{ $data->id }}">
    </div>
   <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ $data->name }}">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ $data->email }}">
    </div>
    <div class="form-group">
      <label for="image">Image:</label>
      <img style="width:25px;height:30px;" src="/images/<?php echo $data->image; ?>"/>
      <input type="file" class="form-control" id="image" placeholder="Enter image" name="image" value="{{ $data->image }}">
    </div>
    <div class="form-group">
      <label for="phone">Phone:</label>
      <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone" value="{{ $data->phone }}">
    </div>
   
    @csrf
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
@endsection
