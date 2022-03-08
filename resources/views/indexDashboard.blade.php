<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('./main.css') }}">

  </head>
  <body>
      <nav class="navbar navbar-expand-lg bg-dark navbarMenu">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto">
              <li class="nav-item">
                <a class="nav-link  {{ (request()->is('main')) ? 'activeBack' : '' }}" href="/main">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  {{ (request()->is('subscription')) ? 'activeBack' : '' }}" href="/subscription">Subscription</a>
              </li>
            </ul>
          </div>
      </nav>
  
    
    @yield('content')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
      $(document).ready(function(){

        function isEmail(email) {
          const regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          return regex.test(email);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function readData(){
          $.ajax({
            type:'GET',
            url:'/jsonSubscription',
            dataType: 'JSON',
            success:function(data)
            {
              // console.log(data);
              let baris ="";

              if(data ==''){
                  $('.tbodyData').html('<tr>\
                    <td colspan="5"><p class="text-light text-center font-weight-bold bg-danger pt-2 pb-2">No data Found</p></td>\
                  </tr>');
              }

              for(let i = 0; i < data.length; i++)
              {
                if(data.length > 0)
                {
                  baris += '<tr>\
                    <td><p style="font-weight: bold; font-family: arial; color:DarkOrchid;" align="center">'+(i+1)+'</p></td>\
                    <td><p style="font-weight: bold; font-family: arial; color:DarkOrchid;">'+data[i].email+'</p></td>\
                    <td><p style="font-weight: bold; font-family: arial; color:DarkOrchid;">'+data[i].ip+'</p></td>\
                    <td><p style="font-weight: bold; font-family: arial; color:DarkOrchid;">'+data[i].created_at+'</p></td>\
                    <td><button id="btnDelete" type="button" class="btn btn-warning" datadel="'+data[i].id+'">Delete</button></td>\
                  </tr>';

                  $('.tbodyData').html(baris);

                }

              }

            }
          })
        }

        readData();

        $('#emailDanger, #IPDanger').css({
            "background-color":"#33ff66",
            "color":"red",
            "padding":"5px 5px",
            "font-weight":"800",
            "border-radius": "5px 5px 5px 5px",
            "display":"none"
        });

        $('.successInput').css({
          "display":"none",
          "font-size":"22px"
        })

        $('#formInput').on('submit', function(e){
          e.preventDefault();

          let formData = {
            email: $("input[name=email]").val(),
            ip: $("input[name=ip]").val()
          } 

          
          if(formData.email==""){
            $('#emailDanger').html('Email tidak boleh kosong');
            $('#emailDanger').fadeIn(1000, function(){
              setTimeout(function() { 
                $('#emailDanger').fadeOut(1000)
              }, 3000);
              
            })
          }

          else if(!isEmail(formData.email)){
            $('#emailDanger').html('Email harus mengandung @');
            $('#emailDanger').fadeIn(1000, function(){
              setTimeout(function() { 
                $('#emailDanger').fadeOut(1000)
              }, 3000);
              
            })
          }

          if(formData.ip==""){
            $('#IPDanger').html('IP tidak boleh kosong');
            $('#IPDanger').fadeIn(1000, function(){
              setTimeout(function() { 
                $('#IPDanger').fadeOut(1000)
              }, 3000);
              
            })
          }

          else if( isNaN(formData.ip)){
            $('#IPDanger').html('IP harus angka');
            $('#IPDanger').fadeIn(1000, function(){
              setTimeout(function() { 
                $('#IPDanger').fadeOut(1000)
              }, 3000);
              
            })
          }

          else if( formData.ip > 10){
            $('#IPDanger').html('IP tidak boleh lebih dari 10 digit');
            $('#IPDanger').fadeIn(1000, function(){
              setTimeout(function() { 
                $('#IPDanger').fadeOut(1000)
              }, 3000);
              
            })
          }

         if(formData.email!='' || formData.ip !='' || isEmail(formData.email) || !isNaN(formData.ip) || formData.ip <= 10 ){
          $.ajax({
              type: "POST",
              url: "/inputSubscribe",
              data: formData,
              dataType: "JSON",
              success:function (data) {
                $('.successInput').html('Data berhasil ditambah');
                $('.successInput').fadeIn(1000, function(){
                  setTimeout(function() { 
                    $('.successInput').fadeOut(1000)
                  }, 4000);
                  
                })


                readData();
                $("input[name=email]").val('');
                $("input[name=ip]").val('');
              }
          });
         }
  
        })

      })

      // Kalau tidak pakai $(document), form tidak akan jalan karena kita buat di jquey, bukan html biasa
      $(document).on('click', '#btnDelete', function(e){
          e.preventDefault();
          
          let pesanDelete = confirm('Are you sure you want to delete this data?');
          let id=$(this).attr('datadel');

          if(pesanDelete == true){
            console.info(id);
            $.ajax({
              url:'/deleteSubs/'+id,
              type:'delete',
              dataType:'JSON',
              data:{
                id:id
              },
              success:function(data){
                Swal.fire({
                  type:'success',
                  icon: 'success',
                  title: 'Delete berhasil',
                  text: 'Data berhasil dihapus!'
                })
                location.reload();
              }
            })
          }

      })

      // 1) Change province
      $('#province').on('change', function(){
         let provinceID = $(this).val(); 
         
         if(provinceID){
            $.ajax({
              type:"GET",
              url:"/getRegency?provinceID="+provinceID ,
              dataType: 'JSON',
              success:function(data){               
                if(data){
                    $("#regency").empty();
                    $('#subdistrict').empty();
                    $("#village").empty();
                    $("#regency").append('<option>---Pilih Regency---</option>');
                    $('#subdistrict').append('<option>--Pilih Subdistrict--</option>');
                    $("#village").append('<option>---Pilih Village---</option>');
                    $.each(data,function(nama,kode){
                        $("#regency").append('<option value="'+kode+'">'+nama+'</option>');
                    });
                }else{
                  $("#regency").empty();
                  $('#subdistrict').empty();
                  $("#village").empty();
                }
              }
          });
         }
      })

      // 2) Change regency
      $('#regency').on('change', function(){
        let regencyID=$(this).val();    
        if(regencyID){
            $.ajax({
              type:"GET",
              url:"/getSubdistrict?regencyID="+regencyID,
              dataType: 'JSON',
              success:function(data){               
                if(data){
                   $('#subdistrict').empty();
                    $("#village").empty();
                    $("#subdistrict").append('<option>---Pilih Subdistrict---</option>');
                    $("#village").append('<option>---Pilih Village---</option>');
                    $.each(data,function(nama,kode){
                        $("#subdistrict").append('<option value="'+kode+'">'+nama+'</option>');
                    });
                }else{
                  $('#subdistrict').empty();
                  $("#village").empty();
                }
              }
            });
        }else{
            $('#subdistrict').empty();
            $("#village").empty();
        }   
       
      })

      // 3) Change subdistrict
      $('#subdistrict').on('change', function(){
        let subdistrictID=$(this).val();    
        if(subdistrictID){
            $.ajax({
              type:"GET",
              url:"/getVillage?subdistrictID="+subdistrictID,
              dataType: 'JSON',
              success:function(data){               
                if(data){
                    $('#village').empty();
                    $("#village").append('<option>---Pilih Subdistrict---</option>');
                    $.each(data,function(nama,kode){
                        $("#village").append('<option value="'+kode+'">'+nama+'</option>');
                    });
                }else{
                  $('#village').empty();
                }
              }
            });
        }else{
            $('#village').empty();
        }  
      })

    </script>

</body>
</html>