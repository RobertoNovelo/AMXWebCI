/*---LEFT BAR ACCORDION----*/
$(document).ready(function() {

    $( "#form_cap" ).hide();
    $( "#form_riskzone" ).hide();
    $( "#form_push" ).hide();

    $.ajax({
            url: "http://ec2-54-68-158-184.us-west-2.compute.amazonaws.com/notificationController/get_CAP_RZ",
            type: "POST",
            data: { type : 0},
            dataType: "json",
            success: function (data) 
            {
                console.log(data);

                $('#cap_table').dataTable({ 
                                "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "Todos"]], 
                                "data": data,
                                "columns": [
                                    { "data": "name" },
                                    { "data": "url" }
                                ]
                            });

            },
            error: function()
            {
            alert("No Data Found");
            }

    });

     $.ajax({
            url: "http://ec2-54-68-158-184.us-west-2.compute.amazonaws.com/notificationController/get_CAP_RZ",
            type: "POST",
            data: { type : 1},
            dataType: "json",
            success: function (data) 
            {
                console.log(data);

                $('#rz_table').dataTable({ 
                                "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "Todos"]], 
                                "data": data,
                                "columns": [
                                    { "data": "name" },
                                    { "data": "url" }
                                ]
                            });

            },
            error: function()
            {
            alert("No Data Found");
            }

    });
    
    $("#view-map").click(function()
    {
        $( "#form_cap" ).hide();
        $( "#form_riskzone" ).hide();
        $( "#form_push" ).hide();
        $("a").removeClass('active');
        $("a", this).addClass('active','slow');
	    $("action-container").hide('slow');
	    $("#googleMap").show('slow');
    });

    $("#sm-addcap").click(function() {
    
    	$("a").removeClass('active');
    	$("a", this).addClass('active','slow');
    
        $( "#form_riskzone" ).slideUp('slow');
        $( "#form_push" ).slideUp('slow');
        $( "#form_cap" ).slideDown('slow');

        $("#googleMap").hide('slow');
	    $("action-container").show('slow');

        reload_cap_table();
    });

    $("#sm-addriskzone").click(function() {
    
    	$("a").removeClass('active');
    	$("a", this).addClass('active','slow');
    	
        $( "#form_cap" ).slideUp('slow');
        $( "#form_push" ).slideUp('slow');
        $( "#form_riskzone" ).slideDown('slow');
        $("#googleMap").hide('slow');
	    $("action-container").show('slow');

        reload_rz_table();
    });

    $("#sm-push").click(function() {
    
    	$("a").removeClass('active');
    	$("a", this).addClass('active','slow');
    	
        $( "#form_cap" ).slideUp('slow');
        $( "#form_riskzone" ).slideUp('slow');
        $( "#form_push" ).slideDown('slow');
        
        $("#googleMap").hide('slow');
	    $("action-container").show('slow');
        
    });

    $("#sendpush_btn").click(function() {

        var message = $("#input_push").val();

        $.ajax({
            url: "/notificationController/send_push",
            type: "POST",
            data: {
                   pushMessage : message
                },
            success: function(data) 
            {
                $("#input_push").http('');
            },
            error: function(errordata)
            {
            }
        });
    });

     $("#submitCAP_btn").click(function() {

        var nombre = $("#input_nombre").val();
        var capUrl = $("#input_capurl").val();

       $.ajax({
          url: "http://ec2-54-68-158-184.us-west-2.compute.amazonaws.com/notificationController/save_cap",
          type: "POST",
          data: {
               nombre : nombre,
               url : capUrl
           },
          success: function(data) 
          {
            reload_cap_table();
          },
          error: function(errordata)
          {
            alert('error');
          }
        });
    
    });

      $("#submitriskzone_btn").click(function() {

        var nombre = $("#input_rz_nombre").val();
        var capUrl = $("#input_rz_capurl").val();

       $.ajax({
          url: "http://ec2-54-68-158-184.us-west-2.compute.amazonaws.com/notificationController/save_risk_zone",
          type: "POST",
          data: {
               nombre : nombre,
               url : capUrl
           },
          success: function(data) 
          {
            reload_rz_table();
          },
          error: function(errordata)
          {
            alert('error');
          }
        });
    
    });

    $("#remove_cap_btn").click(function() {
        $.ajax({
            url: "http://ec2-54-68-158-184.us-west-2.compute.amazonaws.com/notificationController/remove_all",
            type: "POST",
            data: { type : 0 },
            success: function () 
            {
                reload_cap_table();
            }
        });
    
    });

    $("#remove_riskzone_btn").click(function() {
        $.ajax({
            url: "http://ec2-54-68-158-184.us-west-2.compute.amazonaws.com/notificationController/remove_all",
            type: "POST",
            data: { type : 1 },
            success: function () 
            {
                reload_rz_table();
            }
        });
    
    });


});


var Script = function () {


//    sidebar dropdown menu auto scrolling

    jQuery('#sidebar .sub-menu > a').click(function () {
        var o = ($(this).offset());
        diff = 250 - o.top;
        if(diff>0)
            $("#sidebar").scrollTo("-="+Math.abs(diff),500);
        else
            $("#sidebar").scrollTo("+="+Math.abs(diff),500);
    });



//    sidebar toggle

    $(function() {
        function responsiveView() {
            var wSize = $(window).width();
            if (wSize <= 768) {
                $('#container').addClass('sidebar-close');
                $('#sidebar > ul').hide();
            }

            if (wSize > 768) {
                $('#container').removeClass('sidebar-close');
                $('#sidebar > ul').show();
            }
        }
        $(window).on('load', responsiveView);
        $(window).on('resize', responsiveView);
    });

    $('.fa-bars').click(function () {
        if ($('#sidebar > ul').is(":visible") === true) {
            $('#main-content').css({
                'margin-left': '0px'
            });
            $('#sidebar').css({
                'margin-left': '-210px'
            });
            $('#sidebar > ul').hide();
            $("#container").addClass("sidebar-closed");
        } else {
            $('#main-content').css({
                'margin-left': '210px'
            });
            $('#sidebar > ul').show();
            $('#sidebar').css({
                'margin-left': '0'
            });
            $("#container").removeClass("sidebar-closed");
        }
    });

// custom scrollbar
    //$("#sidebar").niceScroll({styler:"fb",cursorcolor:"#E8B10C", cursorwidth: '3', cursorborderradius: '10px', background: '#404040', spacebarenabled:false, cursorborder: ''});

    $("html").niceScroll({styler:"fb",cursorcolor:"#E8B10C", cursorwidth: '6', cursorborderradius: '10px', background: '#404040', spacebarenabled:false,  cursorborder: '', zindex: '1000'});

// widget tools

    jQuery('.panel .tools .fa-chevron-down').click(function () {
        var el = jQuery(this).parents(".panel").children(".panel-body");
        if (jQuery(this).hasClass("fa-chevron-down")) {
            jQuery(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            el.slideDown(200);
        }
    });

    jQuery('.panel .tools .fa-times').click(function () {
        jQuery(this).parents(".panel").parent().remove();
    });


//    tool tips

    $('.tooltips').tooltip();

//    popovers

    $('.popovers').popover();

}();


function initialize()
{

    
$.ajax({
      type: "POST",
      url: "http://ec2-54-68-158-184.us-west-2.compute.amazonaws.com/notificationController/get_alerts",
      dataType: "json",
      success : function(data) {
                    var myCenter=new google.maps.LatLng(22.694857,-103.035121);

                    var mapProp = {
                    center:myCenter,
                    zoom:5,
                    mapTypeId:google.maps.MapTypeId.ROADMAP
                    };

                    var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

                    var i;

                    for( i = 0; i < data.length; i++ ) 
                    {
                      var latLng = new google.maps.LatLng(data[i]['lat'], data[i]['lng']); 
                      var marker=new google.maps.Marker({
                       icon:'/assets/img/Markers_1.png',
                       position:latLng,
                       });

                       marker.setMap(map);
                    }

                }
    });

    
 
}


google.maps.event.addDomListener(window, 'load', initialize);

function reload_cap_table() {
   
    $.ajax({
            url: "http://ec2-54-68-158-184.us-west-2.compute.amazonaws.com/notificationController/get_CAP_RZ",
            type: "POST",
            data: { type : 0 },
            dataType: "json",
            success: function (data) 
            {
                console.log(data);

                var oTable = $('#cap_table').dataTable();
                oTable.fnClearTable();
                oTable.fnAddData(data);
                oTable.fnDraw();
            },
            error: function()
            {

                var oTable = $('#cap_table').dataTable();
                oTable.fnClearTable();
            }

    });
}

function reload_rz_table() {
   
    $.ajax({
            url: "http://ec2-54-68-158-184.us-west-2.compute.amazonaws.com/notificationController/get_CAP_RZ",
            type: "POST",
            data: { type : 1 },
            dataType: "json",
            success: function (data) 
            {
                console.log(data);

                var oTable = $('#rz_table').dataTable();
                oTable.fnClearTable();
                oTable.fnAddData(data);
                oTable.fnDraw();
            },
            error: function()
            {

                var oTable = $('#rztable').dataTable();
                oTable.fnClearTable();
            }

    });
}


