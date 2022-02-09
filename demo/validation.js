    
      view_record();
      get_record();
      update_record();  
      //SignUp();
      // $('#BtnSbmt').click(
      //   function(){
      //     SignUp();  
      //     } 
      //   );




$(document).ready(function(){

      $("#form-signup").validate({
        rules:{
          firstname:'required',
          lastname:'required',
          email:{
            required:true,
            email:true
          },
          dob:'required',
          gender:'required',
          hobby:'required',
          education:'required',
          description:'required',
          profile:'required'
        },
        messages:{
          firstname:"Please enter your firstname",
          lastname:"Please enter your lastname",
          email: "Please enter a valid email address",
          dob: "Please enter your Birth Date",
          gender: "Please select your Gender",
          hobby: "Please select your Hobby",

          education: "Please select your Education",

          description: "Please enter your Description",

          profile: "Please select your Profile"
        }
      });
});
      



      $(document).on('click', '.delete', function(){  
           var id=$(this).data("id3");  
           if(confirm("Are you sure you want to delete this?"))  
           {             

                $.ajax({  
                     url:"delete.php",  
                     method:"POST",  
                     data:{id:id},  
                    cache:false,  
                     success:function(data){
                      $('#danger').show('fade');
                      setTimeout(function(){
                       $('#danger').hide('fade');
                      },3000);
                      view_record();  
                      var data = JSON.parse(data);
                      if (data.statusCode==200) {
                      
                      }
                      else if(data.statusCode==201)
                      {
                        alert('Error occured!!');
                      }
                              
                     }  
                });  
           }  
      }); 

    
function view_record(page)
{
  $.ajax({
    url:'view.php',
    method:'POST',
    data:{page:page},
    success:function(data)
    {
      data = $.parseJSON(data);
      if(data.statusCode==200)
      {
        $('#table').html(data.html); 
      }
    }
  })
}



$(document).on('click','.pagination_link',function(){
  var page = $(this).attr('id');
  //console.log(page);
  view_record(page);
});

function get_record()
{
  $(document).on('click','#btn_edit',function(){
    var id = $(this).attr('data-id2');
    
    $.ajax(
    {
      url:'get_data.php',
      method :'post',
      data:{id:id},
      dataType:'JSON',
      success:function(data)
      {
        $('#id').val(data['id']);
        $('#Firstname').val(data['Firstname']);
        $('#Lastname').val(data['Lastname']);
        $('#Email').val(data['Email']);
        $('#DOB').val(data['DOB']);
        $('#Description').val(data['Description']);
        //$('#Profile').val(data['Profile']);
       
        $("#Education").val(data['Education']);
        $('#update_modal').modal('show');
      
        var gen = data['Gender'];
        console.log(gen);
        $("input[name=Gender][value="+ gen +"]").prop('checked',true);
        var hob = data['Hobby'];
        var arr= hob.split(",");
        console.log(arr);
        for(var j=0;j<arr.length;j++)
        {
          
          $("input[name=Hobby][value="+ arr[j] +"]").attr('checked',true);
          console.log(arr[j]);
        
        }
       

      }
    })
  })
}


function update_record()
{
  $(document).on('click','#bn_update',function()
  {
  var id = $('#id').val();
  var Firstname = $('#Firstname').val();
  var Lastname = $('#Lastname').val();
  var Email = $('#Email').val();
  var DOB = $('#DOB').val();
  var Description = $('#Description').val();
  var Gender = $("input[name=Gender]:checked").val();
  //var Hobby = $('.Hobby').val();
  var Education = $('#Education').val();
  var hob=[];
       $.each($("input[name='Hobby']:checked"),function(){
        hob.push($(this).val());
       });
       all_hob=hob.join(",")
  $.ajax(
  {
    url : 'update.php',
    method:'POST',
    data:{id:id,Firstname:Firstname,Lastname:Lastname,Email:Email,DOB:DOB,Description:Description,Gender:Gender,Hobby:all_hob,Education:Education},
    success:function(data)
    {
        $('#update_modal').modal('hide');
        $('#update').show('fade');
                      setTimeout(function(){
                       $('#update').hide('fade');
                      },3000);
        view_record();
    }
  })

  
  })


}





$(document).on('click','#select_all',function(){
    $(".std_checkbox").prop("checked",this.checked);
     $('#delete').show('fade');
});

$(document).on('click','.std_checkbox',function(){
    if($('.std_checkbox:checked').length==$('.std_checkbox').length){
      $('#select_all').prop('checked',true);
     
    }
    else
    {
      $('#select_all').prop('checked',false);
       $('#delete').show('fade');
    }
});

$(document).on('click','#delete',function(){

    var post_arr = [];

    // Get checked checkboxes
    $('#table input[type=checkbox]').each(function() {
      if ($(this).is(":checked")) {
        var id = this.id;
        var splitid = id.split('_');
        var postid = splitid[1];

        post_arr.push(postid);
        
      }
    });

    if(post_arr.length > 0){

        var isDelete = confirm("Do you really want to delete records?");
        if (isDelete == true) {
           // AJAX Request
           $.ajax({
              url: 'ajaxfile.php',
              type: 'POST',
              data: { post_id: post_arr},
              success: function(response){
                $('#danger').show('fade');
                      setTimeout(function(){
                       $('#danger').hide('fade');
                      },3000);
                 view_record();
              }
           });
        } 
    } 
  });


$(document).on("keyup","#search_param",function(){
  var search_param = $("#search_param").val();
  $.ajax({
    url:'data.php',
    type:'POST',
    data:{search_param:search_param},
    success:function(data){
       $('#table').html(data); 
    }
  });
});




function SignUp()
{
   var pimage = document.getElementById('profile').files[0];
       var UserData = new FormData();
       UserData.append('type', 'SignUp');
       UserData.append('data', Bind_Data());
       UserData.append('pimage', pimage);
       $.ajax({
           type: "POST",
           url: 'save.php',
           data: UserData,
           contentType: false,
           processData: false,
           success: function (data, textStatus, jqXHR) {
                view_record();
              $('#modal').modal('hide');
             
      $('#success').show('fade');
      setTimeout(function(){
        $('#success').hide('fade');
      },3000);
      //view_record();
      var dataResult = JSON.parse(dataResult);
      console.log(dataResult)
      if(dataResult.statusCode==200){
       // $('#modal').modal('hide');
        //view_record();
      }
      else if(dataResult.statusCode==201){
        alert("Error occured !");
      } 
           }
       });
}
function Bind_Data()
{
   let data = {};
   let hb = [];
   $('input:checkbox[name=hobby]:checked').each(function () {
       hb.push($(this).val());
   });
   data['firstname'] = $('#firstname').val();
   data['lastname'] = $('#lastname').val();
   data['email'] = $('#email').val();
   data['dob'] = $('#dob').val();
   data['gender'] = $('input:radio[name=gender]:checked').val();
   data['hobby'] = hb;
   data['education'] = $('#education').val();
  
   data['description'] = $('#description').val();
   //data['profile']=$('#profile').val();
  return JSON.stringify(data);
}