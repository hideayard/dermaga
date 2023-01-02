$(document).ready(function () {
    var tableID = $("#example").DataTable({
        "ajax": {
            url: "getData.php",
            type: "POST"
        }
    });

    var tablePanel = $("#tablePanel").DataTable({
        "ajax": {
            url: "getDataPanel.php",
            type: "POST"
        },
        "select": {
            "style": 'multi',
            // "selector": 'td:first-child'
        },
        // "fixedColumns":   {
        //     "left": 1, 
        // },
        "dom": 'Bfrtip',
        "columnDefs": [ 
            {
                "orderable": false,
                "className": 'select-checkbox',
                "targets":   0
            },
            { "className": "dt-head-center", "targets": [ 0 ] },
        ],

        // "buttons": [
        //     {text: 'Refresh',
        //         action: function ( e, dt, node, config ) {
        //             console.log("Refresh");
        //             dt.ajax.reload();
        //         }
        //     },
        //     {text: 'selectAll',
        //         action: function ( e, dt, node, config ) {
        //             console.log("selectAll");
        //             dt.select.items();
        //         }
        //     }
        //     ,{text: 'selectNone',
        //         action: function ( e, dt, node, config ) {
        //             console.log("selectNone");
        //             dt.ajax.reload();
        //         }
        //     }, 
        // ],
        
    });


    tablePanel.on( 'select', function ( e, dt, type, indexes ) {
        if ( type === 'row' ) {
          let allselected=tablePanel.rows( {selected:true} ).data();
          let selected = tablePanel.rows( indexes ).data();
          let countselected=tablePanel.rows( {selected:true} ).data().length;
          console.log("allselected=",allselected,allselected[0]);
          let detailtext = document.getElementById("detail").value;
          let detailjson = JSON.parse(detailtext);
          detailjson["jumlah"] = countselected;
          let detailDataArray = [];
          let i=0;
          for (i;i<countselected;i++) {
            let text = allselected[i][0];
            let result = text.substring(28);
            const splited = result.split('"');
            detailDataArray.push(splited[0]);
            }
            console.log("detailDataArray=",detailDataArray);
          detailjson["data"] = detailDataArray;
          detailtext = JSON.stringify(detailjson);
          document.getElementById("detail").value = detailtext;
        }
      });
      
      tablePanel.on( 'deselect', function ( e, dt, type, indexes ) {
        if ( type === 'row' ) {
          let allselected=tablePanel.rows( {selected:true} ).data();
          let countselected=tablePanel.rows( {selected:true} ).data().length;
          let detailtext = document.getElementById("detail").value;
          let detailjson = JSON.parse(detailtext);
          detailjson["jumlah"] = countselected;
          let detailDataArray = [];
          let i=0;
          for (i;i<countselected;i++) {
            let text = allselected[i][0];
            let result = text.substring(28);
            const splited = result.split('"');
            detailDataArray.push(splited[0]);
        }
            console.log("detailDataArray=",detailDataArray);
          detailjson["data"] = detailDataArray;
          detailtext = JSON.stringify(detailjson);
          document.getElementById("detail").value = detailtext;
        }
      });

    $(".selectAll").on( "click", function(e) {
        if ($(this).is( ":checked" )) {
            tablePanel.rows(  ).select();        
        } else {
            tablePanel.rows(  ).deselect(); 
        }
    });

    $("#form_add").unbind('submit').bind('submit', function () {
        if(confirm("check form before you submit.")) {
            var form = $(this);
    
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    tableID.ajax.reload();
                    document.getElementById('form_add').reset();
                    alert(response);
                }
            });
        }
        return false;
    });
});

// var addbtn = document.getElementById("addbtn");
// addbtn.addEventListener("click", function(){
//     // show add form
//     document.getElementById('form_add').classList.remove('hideme');
        
//     // hide edit form
//     document.getElementById('form_edit').classList.add('hideme');
// });


function edit(id) {
    if (id) {
        // remove record id
        $("#record_id").remove();

        // hide add form
        document.getElementById('form_add').classList.add('hideme');
        
        // show edit form
        document.getElementById('form_edit').classList.remove('hideme');
        
        // fetch the member data
        $.ajax({
            url: 'getSelectedRecord.php',
            type: 'POST',
            data: { record_id: id },
            dataType: 'json',
            success: function (response) {
                document.getElementById("firstname_edit").value = response.firstname;
                document.getElementById("lastname_edit").value = response.lastname;
                document.getElementById("salary_edit").value = response.salary;
                // include record id
                $("#form_edit").append('<input type="hidden" name="record_id" id="record_id" value="' + id + '"/>');
            
                $("#form_edit").unbind('submit').bind('submit', function () {
                    if(confirm("check form before you submit.")) {
                        var form = $(this);
                        var table = $('#example').DataTable();
                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: form.serialize(),
                            dataType: 'json',
                            success: function (response) {
                                alert(response);
                                table.ajax.reload(null, false);
                            }
                        });
                    }
                    return false;
                });
            }
        });
    } else {
        alert("Error : Refresh the page again");
    }
}

function remove(id) {
    if(id) {
        if(confirm("are you sure?")) {
            var table = $('#example').DataTable();
            $.ajax({
                url: "process.php",
                type: 'POST',
                data: { record_id: id },
                dataType: 'json',
                success: function (response) {
                    alert(response);
                    table.ajax.reload(null, false);
                }
            });
        }
        return false;
    }
}

// money value
function isNumberKey(evt, obj) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    var value = obj.value;
    var dotcontains = value.indexOf(".") != -1;
    if (dotcontains)
        if (charCode == 46) return false;
    if (charCode == 46) return true;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}