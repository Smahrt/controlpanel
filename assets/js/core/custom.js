 $(document).ready(function(){
    
     /* 1. Create account page */                    
        var $user = $("#Username2");
        var $fname = $("#Firstname2");
        var $lname = $("#Lastname2");
        var $pass = $("#Password2");
        var f_user;
        var l_user;
     
    $fname.blur(function(){
        f_user = $('#Firstname2').val().toLowerCase();
   
    });
    $lname.blur(function(){
        l_user = $('#Lastname2').val().toLowerCase();
    });
    $pass.focus(function(){
        if(f_user == "" && l_user == ""){
            $fname.hasFocus();
        }else{
            $user.val(f_user+"."+l_user);
        }
    });
     
    
     /* 2. Logging User Data */
     $('.spook-confirm').click(function(){
         $linkid = $(this).attr("id");
     });
     $('.spook').click(function(){
         $role_check = /admin/i;
         $page_title = $('title').text();
         $page_role = $page_title.search($role_check);
         
         if ($page_role > 0){
             $bounce_page = '../bounce.php';
             $kick_page = '../kick_user.php';
         }else{
             $bounce_page = 'bounce.php';
             $kick_page = 'kick_user.php';
         }
         
         $.post($bounce_page, 'linkid=' + $linkid, function (response) {
             if(response != ""){
                 $('body').prepend("<div class='alert-success alert' role='alert'>Redirecting to "+response+"</div>");
                 setTimeout(function(){
                     $megaIP = response;
                     
                     $.post($kick_page, 'megaIP='+$megaIP, function(ret){
                        if(ret != ""){
                            window.location = "http://"+ret;
                        }else{
                            alert("Mega Error");
                        }
                     });
                     
                 }, 700);
             }else{
                 $('body').append("<div class='alert-error alert' role='alert'>Error logging user data. Please contact your Administrator."+response+"</div>");
             }
        });
         
     });
     
     /* 3. View Users Table */
     $('#viewusertable').DataTable( {
        "dom": 'lCfrtip',
         "order": [],
        "language": {
            "lengthMenu": '_MENU_ entries per page',
            "search": '<i class="fa fa-search"></i>',
            "paginate": {
                "previous": '<i class="fa fa-angle-left"></i>',
                "next": '<i class="fa fa-angle-right"></i>'
            }
        }
    } );
     
      /* 4. Users Stats Table */
     $('#usertable').DataTable( {
        "dom": 'lCfrtip',
        "processing" : true,
        "ajax" : {
            "url" : "userstats",
            dataSrc : ''
        },
        "colVis": {
            "buttonText": "Columns",
            "overlayFade": 0,
            "align": "right"
        },
        "language": {
            "lengthMenu": '_MENU_ entries per page',
            "search": '<i class="fa fa-search"></i>',
            "paginate": {
                "previous": '<i class="fa fa-angle-left"></i>',
                "next": '<i class="fa fa-angle-right"></i>'
            }
        },
        "columns" : [
            {"data": "firstname"},
            {"data": "lastname"},
            {"data": "gender"},
            {"data": "location"},
            {"data": "date_logged_in"},
            {"data": "time_logged_in"},
            {"data": "aggregator"},
            {"data": "access_time"}
        ]
    } );
     
     /* 5. Modify User Data */
     $('.edit_user').click(function(){
         $uname = $(this).attr("id");
         
         $.post('adbounce.php', 'username='+$uname, function(response){
            window.location = 'edit_user.php';
         });
     });
     
     /* 6. Add Aggregator Links */
     $('#add-link').click(function(){
        var $linkname = $('#link-name').val();
        var $ipaddress = $('#ip-address').val();
        
        var IPformat = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
         
        var checkIP = $ipaddress.match(IPformat);
        
        if(checkIP){
            $.post('add_link.php', {
            title: $linkname,
            ip: $ipaddress
            }, function(response){
               if(response == "Success"){
                   $('.modal-body').prepend("<div class='alert alert-success'>Link added successfully</div>");
                   setTimeout(function(){
                      location.reload(); 
                   }, 1300);
               }else{
                   $('.modal-body').prepend("<div class='alert alert-danger'>Failed to add link</div>");
               }
            });
        }else{
            $('.modal-body').prepend("<div class='alert alert-danger'>Invalid IP address</div>");
        }
     });
     
     /* 7. Delete Aggregator Links */
     $('.end-link-confirm').click(function(){
         $link_id = $(this).attr("id");
     });
     $('.end-link').click(function(){
        $.post('delete_link.php', 'link_id='+$link_id, function(response){
            if(response == "Success"){
                $('.modal-body').prepend("<div class='alert alert-success'>Link removed successfully</div>");
               setTimeout(function(){
                  location.reload(); 
               }, 1300);
           }else{
               $('.modal-body').prepend("<div class='alert alert-danger'>Failed to remove link</div>");
           }
        });
     });
     
     /* 8. Delete User */
     $('.confirm-kill-user').click(function(){
         $iduser = $(this).attr("id");
     });
     $('.kill-user').click(function(){
        $.post('delete_user.php', 'userid='+$iduser, function(response){
            if(response == "Success"){
                $('.modal-body').prepend("<div class='alert alert-success'>User removed successfully</div>");
               setTimeout(function(){
                  location.reload(); 
               }, 1300);
           }else{
               $('.modal-body').prepend("<div class='alert alert-danger'>Failed to remove user</div>");
           }
        });
     });
     
});