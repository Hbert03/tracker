function confirmLogout1() {
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
            document.getElementById("logoutForm1").submit();
        }
    });
}

$(document).ready(function() {
    function formatDate(dateString) {
        let date = new Date(dateString);
        let options = { year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    }
    
    let table = $('#example4').DataTable({
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
            { "data": "fullname" },
            { "data": "position" },
            { "data": "purpose_travel" },
            { "data": "destination" },
            { "data": "date_start", 
                "render": function(data, type, row) {
                    return formatDate(data);
                }
            },
            { "data": "date_end", 
                "render": function(data, type, row) {
                    return formatDate(data);
                } 
            },
            { "data": "status" },
            { "data": "actions" } 
        ]
    });

    $('#example4 tbody').on('click', '.approve-btn', function() {
        let id = $(this).data('id');
        updateStatus(id, 'Approved');
    });

    $('#example4 tbody').on('click', '.reject-btn', function() {
        let id = $(this).data('id');
        updateStatus(id, 'Disapproved');
    });


    function updateStatus(id, status) {
        $.ajax({
            url: 'update_status.php',
            type: 'POST',
            data: {
                id: id,
                status: status
            },
            success: function(response) {
                table.ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
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

    let table = $('#pass_slip').DataTable({
        serverSide: true,
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        ajax: {
            url: "fetch.php",
            type: "POST",
            data: { pass_slip: true },
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
            { "data": "actions" }
        ]
    });

    $('#pass_slip tbody').on('click', '.approve-btn', function() {
        let id = $(this).data('id');
        updateStatus1(id, 'Approved');
    });

    $('#pass_slip tbody').on('click', '.reject-btn', function() {
        let id = $(this).data('id');
        updateStatus1(id, 'Disapproved');
    });

    function updateStatus1(id, status) {
        $.ajax({
            url: 'update_status1.php',
            type: 'POST',
            data: {
                id: id,
                status: status
            },
            success: function(response) {
                table.ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
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

    let table = $('#locator_Slip').DataTable({
        serverSide: true,
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        ajax: {
            url: "fetch.php",
            type: "POST",
            data: { locator_Slip: true },
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
            { "data": "actions" }
        ]
    });

    $('#locator_Slip tbody').on('click', '.approve-btn', function() {
        let id = $(this).data('id');
        updateStatus2(id, 'Approved');
    });

    $('#locator_Slip tbody').on('click', '.reject-btn', function() {
        let id = $(this).data('id');
        updateStatus2(id, 'Disapproved');
    });

    function updateStatus2(id, status) {
        $.ajax({
            url: 'update_status2.php',
            type: 'POST',
            data: {
                id: id,
                status: status
            },
            success: function(response) {
                table.ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
});


$(document).ready(function() {
    function formatDate(dateString) {
        let date = new Date(dateString);
        let options = { year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    }
    $('#travelOrder').DataTable({
        serverSide: true,
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        ajax: {
            url: "fetch.php",
            type: "POST",
            data: { travelOrder: true },
            error: function(xhr, error, thrown) {
                console.log("Ajax request failed: " + thrown);
            }
        },
        columns: [
            { "data": "fullname" },
            { "data": "position" },
            { "data": "purpose_travel" },
            { "data": "destination" },
            { "data": "date_start", 
                "render": function(data, type, row) {
                    return formatDate(data);
                }
            },
            { "data": "date_end", 
                "render": function(data, type, row) {
                    return formatDate(data);
                } 
            },
            { "data": "status" },
        ]
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

    $('#locatorSlip').DataTable({
        serverSide: true,
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        ajax: {
            url: "fetch.php",
            type: "POST",
            data: { locatorSlip: true },
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
        ]
    })
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
    
        $('#sample').DataTable({
            serverSide: true,
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            ajax: {
                url: "fetch.php",
                type: "POST",
                data: { sample: true },
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
            ]
        })
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
        
            $('#sample1').DataTable({
                serverSide: true,
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                ajax: {
                    url: "fetch.php",
                    type: "POST",
                    data: { sample1: true },
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
                ]
            })
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
    
        $('#passSlip').DataTable({
            serverSide: true,
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            ajax: {
                url: "fetch.php",
                type: "POST",
                data: { passSlip: true },
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
            ]
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
        
            let table = $('#locatorslip1').DataTable({
                serverSide: true,
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                ajax: {
                    url: "fetch.php",
                    type: "POST",
                    data: { locatorslip1: true },
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
                    { "data": "actions" }
                ]
            });
        
            $('#locatorslip1 tbody').on('click', '.approve-btn', function() {
                let id = $(this).data('id');
                updateStatus2(id, 'Approved');
            });
        
            $('#locatorslip1 tbody').on('click', '.reject-btn', function() {
                let id = $(this).data('id');
                updateStatus2(id, 'Disapproved');
            });
        
            function updateStatus2(id, status) {
                $.ajax({
                    url: 'update_status3.php',
                    type: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    success: function(response) {
                        table.ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });
        

    