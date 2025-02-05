import axios from "axios";

console.log('Dev Console ------------ Attendance Page');

let attendanceStart = false;


const form = document.getElementById('attendanceForm');

function post(form){
    console.log('working')
    let isRecorded = false;
    axios.post(form.get('uri'), form, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        console.log("Response",response.data);
        isRecorded = true;
    })
    .catch(error =>{
        console.log("Error:", error)
    });

    return isRecorded;
}


// PREVENT THE FORM FROM SUBMITTING AND REDIRECTING TO A PAGE
 form.addEventListener('submit',event=>{
    event.preventDefault();
   let isRecorded = post(new FormData(event.target));
    // notify(isRecorded, "")
    // let isFetch = setTimeout(get(), 500);
    // notify(isFetch, "")
});

// LOAD THE TABLE => GET
function get(){
    let uri = document.getElementById('getURI').value
    let isFetch = false
    axios.get(uri)
    .then( response => {
        console.log("Response",response);
        isFetch = true;
    })
    .catch(error=>{
        console.log("Error:", error)
    });

    return isFetch;
}

// FOR NOTIFICATIONS ETC

function notify(status, content){

}

function error(status, content){

}


