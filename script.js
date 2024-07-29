function confirmLogout() {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will be logged out!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("logoutForm").submit();
        }
    });
}

$("button.btn1").on("click", function(event) {
    event.preventDefault(); 

    var requiredFilled = true;
    $("#myForm input, #myForm select").each(function() {
        if ($(this).prop("required") && $(this).val() === "") {
            requiredFilled = false;
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
        }
    });

 
    if ($("#myForm")[0].checkValidity()) { 
        var startDate = new Date($("#start_date").val());
        var endDate = new Date($("#end_date").val());
        
        if (startDate <= endDate) {
            $.ajax({
                url: "function.php",
                type: "POST",
                data: $("#myForm").serialize() + "&save=true",
                success: function(response) {
                    if (response == "1") {
                        Swal.fire({
                            icon: "success",
                            title: "Form Submitted",
                            showConfirmButton: true,
                        });
                    } else {
                        toastr.error("Failed to save data");
                    }
                }
            });
        } else {
            toastr.error("End date must be after start date.");
        }
    }
});



$("button.btn2").on("click", function(event){
    event.preventDefault(); 

    $("#myForm1 input").each(function() {
        if ($(this).val() === "") {
            requiredFilled = false;
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
        }
    });
    if ($("#myForm1")[0].checkValidity()) { 
        var start_time = $("#start_time").val();
        var end_time = $("#end_time").val();
        var start_time = new Date('1970-01-01T' + start_time + 'Z');
        var end_time = new Date('1970-01-01T' + end_time + 'Z');
        if (start_time <= end_time) {
            $.ajax({
                url: "function.php",
                type: "POST",
                data: $("#myForm1").serialize() + "&save2=true",
                success: function(response){
                    if (response == "1"){
                       Swal.fire({
                         icon: "success",
                         title: "Form Submitted",
                         showConfirmButton: true,
                       });
                    } else {
                        toastr.error("Failed to save data");
                    }
                }
            });
        } else {
            toastr.error("Validate the Time you choose");
        }
    } else {
        toastr.error("Please fill out all required fields.");
    }
});


$("button.btn3").on("click", function(event){
    event.preventDefault(); 

    $("#myForm3 input").each(function() {
        if ($(this).val() === "") {
            requiredFilled = false;
            $(this).addClass("is-invalid");
        } else {
            $(this).removeClass("is-invalid");
        }
    });
    if ($("#myForm3")[0].checkValidity()) { 
            $.ajax({
                url: "function.php",
                type: "POST",
                data: $("#myForm3").serialize() + "&save3=true",
                success: function(response){
                    if (response == "1"){
                       Swal.fire({
                         icon: "success",
                         title: "Form Submitted",
                         showConfirmButton: true,
                       });
                    } else {
                        toastr.error("Failed to save data");
                    }
                }
            });
    } else {
        toastr.error("Please fill out all required fields.");
    }
});


$(document).ready(function() {
    function formatDate(dateString) {
        let date = new Date(dateString);
        let options = { year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    }
    
    $('#example').DataTable({
        serverSide: true,
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        ajax: {
            url: "fetch.php",
            type: "POST",
            data: { fetch: true },
            error: function(xhr, error, thrown) {
                console.log("Ajax request failed: " + thrown);
            }
        },
        columns: [
            { 
                "data": "fullname",
                "render": function(data, type, row) {
                    let fullName = data;
                    if (row.join_users) {
                        fullName += " <i class='fas fa-eye view-tagged-users' style='color:blue; cursor: pointer' data-toggle='tooltip' title='" + row.join_users + "'></i>";
                    }
                    return fullName;
                }
            },
            { "data": "position" },
            { "data": "purpose_travel" },
            { "data": "destination" },
            { 
                "data": "date_start",
                "render": function(data, type, row) {
                    return formatDate(data);
                }
            },
            { 
                "data": "date_end", 
                "render": function(data, type, row) {
                    return formatDate(data);
                }
            },
            { "data": "status" },
            {
                "data": null,
                "render": function(data, type, row) {
                    return "<button style='background-color:transparent; justify-content:center' class='btn btn-primary print' data-personnel='" + row.id + "'><span><i style='color:blue' class='fas fa-print'></i></span></button>" +
                           "<button style='background-color:transparent; justify-content:center' class='btn btn-primary ms-2 download' data-personnel='" + row.id + "'><span><i style='color:green' class='fas fa-download'></i></span></button>";
                }
            }
        ],
        "drawCallback": function(settings) {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });

        $('#example tbody').on('click', 'button.print', function() {
            var id = $(this).data('personnel');
            $.ajax({
                url: 'fetch_data.php',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    var data = JSON.parse(response);
    
                    var startDate = new Date(data.date_start);
                    var endDate = new Date(data.date_end);
                    var options = { month: 'short', day: 'numeric', year: 'numeric' };
    
                    var formattedDates;
                    if (startDate.getTime() === endDate.getTime()) {
                        formattedDates = startDate.toLocaleDateString('en-US', options);
                    } else if (startDate.getMonth() === endDate.getMonth() && startDate.getFullYear() === endDate.getFullYear()) {
                        var month = startDate.toLocaleDateString('en-US', { month: 'long' });
                        var startDay = startDate.getDate();
                        var endDay = endDate.getDate();
                        var year = startDate.getFullYear();
                        formattedDates = `${month} ${startDay}-${endDay}, ${year}`;
                    } else {
                        formattedDates = `${startDate.toLocaleDateString('en-US', options)} - ${endDate.toLocaleDateString('en-US', options)}`;
                    }
    
                    var fullnameList = data.fullname;
                    if (data.join_user) {
                        fullnameList += ", " + data.join_user;
                    }
                    
                    var positionList = data.position;
                    if (data.join_position) {
                        positionList += ", " + data.join_position;
                    }
                    $('#printTable').find('td').eq(0).text(fullnameList); 
                    $('#printTable').find('td').eq(1).text(positionList);
                    $('#printTable').find('td').eq(2).text(data.station);
                    $('#printTable').find('td').eq(3).text(data.purpose_travel);
                    $('#printTable').find('td').eq(4).text(data.host_activity);
                    $('#printTable').find('td').eq(5).text(formattedDates); 
                    $('#printTable').find('td').eq(6).text(data.destination);
                    $('#printTable').find('td').eq(7).text(data.fund_source);
    
                    var nameSignatureHtml = "";
                    fullnameList.split(", ").forEach(function(name) {
                        nameSignatureHtml += '<div><p class="name-signature">' + name + '</p><p>Date: ____________________</p></div>' + '</p><p style="margin-top:-3em; font-weight:normal">Name and Signature of Requesting Employee</p></div>';
                    });
                    $('.signature').html(nameSignatureHtml);
                    
    
                    $('#personnelForm').show();
    
                    html2canvas(document.getElementById('personnelForm')).then(function(canvas) {
                        var imgData = canvas.toDataURL('image/png');
                        var printWindow = window.open('', '_blank');
                        printWindow.document.write('<html><head><title>Print</title>');
                        printWindow.document.write('<style>');
                        printWindow.document.write('@page { size: 8.5in 13in; margin: 0;  } body { margin: 0;}');

                        printWindow.document.write('</style>');
                        printWindow.document.write('</head><body>');
                        printWindow.document.write('<img src="' + imgData + '" style="width: 100%; height: auto;"/>');
                        printWindow.document.write('</body></html>');
                        printWindow.document.close();
                        printWindow.onload = function() {
                            printWindow.print();
                            printWindow.close();
                        };
    
                        $('#personnelForm').hide();
                    });
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + error);
                }
            });
        });
    });
    

$('#example tbody').on('click', 'button.download', function() {
    var id = $(this).data('personnel');
    console.log(id);
    $.ajax({
        url: 'fetch_data.php',
        type: 'POST',
        data: { id: id },
        success: function(response) {
            var data = JSON.parse(response);

            var startDate = new Date(data.date_start);
            var endDate = new Date(data.date_end);
            var options = { month: 'short', day: 'numeric', year: 'numeric' };

            var formattedDates;
            if (startDate.getTime() === endDate.getTime()) {
                formattedDates = startDate.toLocaleDateString('en-US', options);
            } else if (startDate.getMonth() === endDate.getMonth() && startDate.getFullYear() === endDate.getFullYear()) {
                var month = startDate.toLocaleDateString('en-US', { month: 'long' });
                var startDay = startDate.getDate();
                var endDay = endDate.getDate();
                var year = startDate.getFullYear();
                formattedDates = `${month} ${startDay}-${endDay}, ${year}`;
            } else {
                formattedDates = `${startDate.toLocaleDateString('en-US', options)} - ${endDate.toLocaleDateString('en-US', options)}`;
            }

            $('#printTable').find('td').eq(0).text(data.fullname);
            $('#printTable').find('td').eq(1).text(data.position);
            $('#printTable').find('td').eq(2).text(data.station);
            $('#printTable').find('td').eq(3).text(data.purpose_travel);
            $('#printTable').find('td').eq(4).text(data.host_activity);
            $('#printTable').find('td').eq(5).text(formattedDates); 
            $('#printTable').find('td').eq(6).text(data.destination);
            $('#printTable').find('td').eq(7).text(data.fund_source);
            $('.name-signature').text(data.fullname);

            $('#personnelForm').show();

            html2canvas(document.getElementById('personnelForm')).then(function(canvas) {
                var imgData = canvas.toDataURL('image/png');
                const { jsPDF } = window.jspdf;

              
                const pageWidth = 8.5 * 72;   
                const pageHeight = 13 * 72; 
                
             
                var doc = new jsPDF({
                    orientation: 'portrait',   
                    unit: 'pt',               
                    format: [pageWidth, pageHeight] 
                });
                
             
                var imgData = canvas.toDataURL('image/png');
                var imgWidth = pageWidth;
                var imgHeight = canvas.height * imgWidth / canvas.width;
                var heightLeft = imgHeight;
                var position = 0;
                
             
                doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
                
           
                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    doc.addPage();
                    doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }
                
                doc.save('Travel Order.pdf');
                $('#personnelForm').hide();
            });
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
});

$(document).ready(function() {
    function formatTimeTo12Hour(time) {
        let [hours, minutes] = time.split(':').map(Number);
        let suffix = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12 || 12;
        return `${hours}:${minutes < 10 ? '0' + minutes : minutes} ${suffix}`;
    }

    function formatDate(dateString) {
        let date = new Date(dateString);
        let options = { year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    }

    $('#example1').DataTable({
        serverSide: true,
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        ajax: {
            url: "fetch.php",
            type: "POST",
            data: { fetch2: true },
            error: function(xhr, error, thrown) {
                console.log("Ajax request failed: " + thrown);
            }
        },
        columns: [
            { "data": "Name" },
            { "data": "section" },
            { "data": "position" },
            {
                "data": "time_leave",
                "render": function(data, type, row) {
                    return formatTimeTo12Hour(data);
                }
            },
            {
                "data": "time_return",
                "render": function(data, type, row) {
                    return formatTimeTo12Hour(data);
                }
            },
            { "data": "purpose" },
            {
                "data": "date",
                "render": function(data, type, row) {
                    return formatDate(data);
                }
            },
            { "data": "status" },
            {
                "data": null,
                "render": function(data, type, row) {
                    return "<button style='background-color:transparent; justify-content:center' class='btn btn-primary print text-center' data-personnel1='" + row.id + "' data-bs-toggle='tooltip' data-bs-placement='top' title='Print'><span><i style='color:blue' class='fas fa-print'></i></span></button>" +
                    "<button style='background-color:transparent; justify-content:center' class='btn btn-primary ms-2 download' data-personnel1='" + row.id + "' data-bs-toggle='tooltip' data-bs-placement='top' title='Download'><span><i style='color:green;' class='fas fa-download'></i></span></button>";
                }
            }
        ],
        drawCallback: function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    });




    $('#example1 tbody').on('click', 'button.print', function() {
        var id = $(this).data('personnel1');
        $.ajax({
            url: 'fetch1.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                var data = JSON.parse(response);
                function formatDate(dateString) {
                    let date = new Date(dateString);
                    let options = { year: 'numeric', month: 'long', day: 'numeric' };
                    return date.toLocaleDateString('en-US', options);
                }
                function formatTimeTo12Hour(time24) {
                    let [hours, minutes] = time24.split(':');
                    hours = parseInt(hours);
                    const ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12; 
                    minutes = minutes.padStart(2, '0');
                    return `${hours}:${minutes} ${ampm}`;
                }

                $('input.date').val(formatDate(data.date));
                $('input.name').val(data.Name);
                $('input.section').val(data.section);
                $('input.position').val(data.position);
                $('input.time_leave').val(formatTimeTo12Hour(data.time_leave));
                $('input.time_return').val(formatTimeTo12Hour(data.time_return)); 
                $('input.purpose').val(data.purpose);
                $('.signature').text(data.Name);

                $('#personnelForm1').show();
          
                html2canvas(document.getElementById('personnelForm1')).then(function(canvas) {
                    var imgData = canvas.toDataURL('image/png');
                    
                 
                    var printWindow = window.open('', '_blank');
                    printWindow.document.write('<html><head><title>Print</title>');
                    printWindow.document.write('<style>@page { size: A4; margin: 0; } body { margin: 0; }</style>');
                    printWindow.document.write('</head><body>');
                    printWindow.document.write('<img src="' + imgData + '" style="width: 100%; height: auto;"/>');
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.onload = function() {
                        printWindow.print();
                        printWindow.close();
                    };

                    $('#personnelForm1').hide();
                });
            },
            error: function(xhr, status, error) {
                console.log('Error: ' + error);
            }
        });
    });
});

$('#example1 tbody').on('click', 'button.download', function() {
  var id = $(this).data('personnel1');
        $.ajax({
            url: 'fetch1.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                var data = JSON.parse(response);
                function formatDate(dateString) {
                    let date = new Date(dateString);
                    let options = { year: 'numeric', month: 'long', day: 'numeric' };
                    return date.toLocaleDateString('en-US', options);
                }
                function formatTimeTo12Hour(time24) {
                    let [hours, minutes] = time24.split(':');
                    hours = parseInt(hours);
                    const ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12; 
                    minutes = minutes.padStart(2, '0');
                    return `${hours}:${minutes} ${ampm}`;
                }

                $('input.date').val(formatDate(data.date));
                $('input.name').val(data.Name);
                $('input.section').val(data.section);
                $('input.position').val(data.position);
                $('input.time_leave').val(formatTimeTo12Hour(data.time_leave));
                $('input.time_return').val(formatTimeTo12Hour(data.time_return)); 
                $('input.purpose').val(data.purpose);
                $('.signature').text(data.Name);

                $('#personnelForm1').show();
          
                html2canvas(document.getElementById('personnelForm1')).then(function(canvas) {
                    var imgData = canvas.toDataURL('image/png');
                    
                
                const { jsPDF } = window.jspdf;
                var doc = new jsPDF('p', 'pt', 'a4'); 
                var imgWidth = 595.28;
                var pageHeight = 841.89;
                var imgHeight = canvas.height * imgWidth / canvas.width;
                var heightLeft = imgHeight;
                var position = 0;

                doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    doc.addPage();
                    doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                doc.save('Pass Slip.pdf');
                $('#personnelForm1').hide();
            });
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
});


$(document).ready(function() {
    function formatDateTime(dateTimeString) {
        let date = new Date(dateTimeString);
        
  
        let optionsDate = { year: 'numeric', month: 'long', day: 'numeric' };
        let formattedDate = date.toLocaleDateString('en-US', optionsDate);
    
        let hours = date.getHours();
        let minutes = date.getMinutes();
        let ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; 
        let formattedTime = (hours < 10 ? '0' + hours : hours) + ':' + (minutes < 10 ? '0' + minutes : minutes) + ' ' + ampm;

        return `${formattedDate} ${formattedTime}`;
    }

    $('#example2').DataTable({
        serverSide: true,
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        ajax: {
            url: "fetch.php",
            type: "POST",
            data: { fetch3: true },
            error: function(xhr, error, thrown) {
                console.log("Ajax request failed: " + thrown);
            }
        },
        columns: [
            { "data": "name" },
            { "data": "position" },
            { "data": "permanent_position" },
            { "data": "purpose_travel" },
            {
                "data": "datetime",
                "render": function(data, type, row) {
                    return formatDateTime(data);
                }
            },
            { "data": "official" },
            { "data": "destination" },
            { "data": "status" },
            {
                "data": null,
                "render": function(data, type, row) {
                    return "<button style='background-color:transparent; justify-content:center' class='btn btn-primary print' data-personnel2='" + row.id + "'><span><i style='color:blue' class='fas fa-print'></i></span></button>" +
                    "<button style='background-color:transparent; justify-content:center' class='btn btn-primary ms-2 download' data-personnel2='" + row.id + "'><span><i style='color:green' class='fas fa-download'></i></span></button>";
                }
            }
        ]
    });



    $('#example2 tbody').on('click', 'button.print', function() {
        var id = $(this).data('personnel2');
        $.ajax({
            url: 'fetch2.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                var data = JSON.parse(response);
                function formatDateTime(dateTimeString) {
                    let date = new Date(dateTimeString);
                    let optionsDate = { year: 'numeric', month: 'long', day: 'numeric' };
                    let optionsTime = { hour: 'numeric', minute: 'numeric', hour12: true };
                    let formattedDate = date.toLocaleDateString('en-US', optionsDate);
                    let formattedTime = date.toLocaleTimeString('en-US', optionsTime);
                    return `${formattedDate} - ${formattedTime}`;
                }
                $('#printTable2').find('td').eq(0).text(data.name);
                $('#printTable2').find('td').eq(1).text(data.position);
                $('#printTable2').find('td').eq(2).text(data.permanent_position);
                $('#printTable2').find('td').eq(3).text(data.purpose_travel);
                $('#printTable2').find('td').eq(4).text(data.official);
                $('#printTable2').find('td').eq(5).text(formatDateTime(data.datetime));
                $('#printTable2').find('td').eq(6).text(data.destination);
                $('.name-signature1').text(data.name);

                $('#personnelForm2').show();
          
                html2canvas(document.getElementById('personnelForm2')).then(function(canvas) {
                    var imgData = canvas.toDataURL('image/png');
                    
                 
                    var printWindow = window.open('', '_blank');
                    printWindow.document.write('<html><head><title>Print</title>');
                    printWindow.document.write('<style>@page { size: A4; margin: 0; } body { margin: 0; }</style>');
                    printWindow.document.write('</head><body>');
                    printWindow.document.write('<img src="' + imgData + '" style="width: 100%; height: auto;"/>');
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.onload = function() {
                        printWindow.print();
                        printWindow.close();
                    };

                    $('#personnelForm2').hide();
                });
            },
            error: function(xhr, status, error) {
                console.log('Error: ' + error);
            }
        });
    });
});



$('#example2 tbody').on('click', 'button.download', function() {
    var id = $(this).data('personnel2');
    $.ajax({
        url: 'fetch2.php',
        type: 'POST',
        data: { id: id },
        success: function(response) {
            var data = JSON.parse(response);
            function formatDateTime(dateTimeString) {
                let date = new Date(dateTimeString);
                let optionsDate = { year: 'numeric', month: 'long', day: 'numeric' };
                let optionsTime = { hour: 'numeric', minute: 'numeric', hour12: true };
                let formattedDate = date.toLocaleDateString('en-US', optionsDate);
                let formattedTime = date.toLocaleTimeString('en-US', optionsTime);
                return `${formattedDate} - ${formattedTime}`;
            }
            $('#printTable2').find('td').eq(0).text(data.name);
            $('#printTable2').find('td').eq(1).text(data.position);
            $('#printTable2').find('td').eq(2).text(data.permanent_position);
            $('#printTable2').find('td').eq(3).text(data.purpose_travel);
            $('#printTable2').find('td').eq(4).text(data.official);
            $('#printTable2').find('td').eq(5).text(formatDateTime(data.datetime));
            $('#printTable2').find('td').eq(6).text(data.destination);
            $('.name-signature1').text(data.name);

            $('#personnelForm2').show();
      
            html2canvas(document.getElementById('personnelForm2')).then(function(canvas) {
                var imgData = canvas.toDataURL('image/png');
                
                
                const { jsPDF } = window.jspdf;
                var doc = new jsPDF('p', 'pt', 'a4'); 
                var imgWidth = 595.28;
                var pageHeight = 841.89;
                var imgHeight = canvas.height * imgWidth / canvas.width;
                var heightLeft = imgHeight;
                var position = 0;

                doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    doc.addPage();
                    doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                doc.save('Locator Slip.pdf');
                $('#personnelForm2').hide();
            });
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
});




$(document).ready(function() {
    $("button.btn1").on("click", function(event){
        event.preventDefault();
        

        $("input, select").removeClass("invalid");
        
      
        let isValid = true;
        
        $("#myForm").find("input[required], select[required]").each(function() {
            if ($(this).val() === "") {
                $(this).addClass("invalid");
                isValid = false;
            }
        });

        if (isValid) {
            var formData = $("#myForm").serializeArray();
            var mainSelect = document.getElementById('mainSelect').value;

            if (mainSelect !== 'SENIOR HIGH SCHOOL') {
                formData = formData.filter(function(field) {
                    return field.name !== 'major2';
                });
            }

            $.ajax({
                url: "function.php",
                type: "POST",
                data: $.param(formData) + "&save=true",
                success: function(response){
                    if (response == "1"){
                        Swal.fire({
                            icon: "success",
                            title: "Form Submitted",
                            showConfirmButton: true,
                        });
                    } else {
                        toastr.error("Verify your Entry");
                    }
                }
            });
        } else {
            toastr.error("Please fill out all required fields.");
        }
    });
});

$(document).ready(function() {
    $('select.employee').select2({
        theme: 'bootstrap4',
        placeholder: 'Add Personnel if Necessary',
        multiple: true, 
        ajax: {
            url: 'fetch3.php',
            type: 'post',
            dataType: "json",
            delay: 250,
            data: function(params) {
                return {
                    fetch_personnel: true,
                    term: params.term
                };
            },
            processResults: function(data) {
                return {
                    results: $.map(data.results, function(district) {
                        return {
                            id: district.hris_code,
                            text: district.fullname
                        };
                    })
                };
            },
            cache: true
        },
        minimumInputLength: 0,
        allowClear: true
    });
});
