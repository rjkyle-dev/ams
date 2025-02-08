
function updateStudent(data){
    console.log(data);
    console.log(data.s_rfid)
    document.getElementById('s_RFID').value = data.s_rfid
    document.getElementById('s_STUDENTID').value = data.s_studentID
    document.getElementById('s_MNAME').value = data.s_mname
    document.getElementById('s_FNAME').value = data.s_fname
    document.getElementById('s_LNAME').value = data.s_lname
    document.getElementById('s_SUFFIX').value = data.s_suffix
    document.getElementById('s_PROGRAM').value = data.s_program
    document.getElementById('s_STATUS').value = data.s_status
    document.getElementById('s_LVL').value = data.s_lvl
    document.getElementById('s_SET').value = data.s_set
    document.getElementById('s_ID').value = data.id
}
function deleteStudent(data){
    Swal.fire({
        title: "Chotto Matte Kudasai!!!",
        html: `
                <strong>Are you sure to delete this student's data?</strong>
            `,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
            console.log(data)
            document.getElementById('s_id').value = data.id
            document.getElementById('deleteStudent').submit()
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "User Deleted Successfully",
                showConfirmButton: false,
                timer: 1500
            });
        }
    });

    
}

document.updateStudent = updateStudent
document.deleteStudent = deleteStudent
