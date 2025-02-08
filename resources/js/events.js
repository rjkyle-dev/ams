window.editEvent = editEvent;
window.deleteEvent = deleteEvent;


function editEvent(data){
    console.log('editing event')
    console.log(data)
    document.getElementById('evn_name').value = data.event_name;
    document.getElementById('evn_id').value = data.id;
    document.getElementById('evn_date').value = data.date;
    document.getElementById('in_start').value = data.checkIn_start;
    document.getElementById('in_end').value = data.checkIn_end;
    document.getElementById('out_start').value = data.checkOut_start;   
    document.getElementById('out_end').value = data.checkOut_end;
    // document.getElementById('date').value = data.date;
}


function deleteEvent(data){
    Swal.fire({
        title: "Chotto Matte Kudasai!!!",
        html: `
                <strong>Are you sure to delete this Event's data?</strong>
            `,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
            console.log('deleting event')
            console.log(data)
            document.getElementById('s_id').value = data.id
            document.getElementById('deleteForm').submit()

            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Event Deleted Successfully",
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
}
