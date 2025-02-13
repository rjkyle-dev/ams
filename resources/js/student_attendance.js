import axios from "axios";

console.log("Dev Console ------------ Attendance Page");

let attendanceStart = false;
const form = document.getElementById("attendanceForm");
const form_auto = document.getElementById("auto_attendanceForm");

window.startInterval = startInterval;
window.stopInterval = stopInterval;

// Time Interval to foucs on field for attendance
let intervalId = setInterval(() => {
    console.log("Hello World");
    document.getElementById("inputField1").focus();
}, 500);

function stopInterval() {
    clearInterval(intervalId);
    console.log("Interval stopped!");
}

function startInterval() {
    stopInterval();
    intervalId = setInterval(() => {
        console.log("Hello World");
        document.getElementById("inputField1").focus();
    }, 500);
}

async function post(form) {
    let isRecorded = false;
    const response = await axios.post(form.get("uri"), form, {
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
            "Content-Type": "application/json",
        },
    });
    console.log(response.data);
    return response.data;
}

// PREVENT THE FORM FROM SUBMITTING AND REDIRECTING TO A PAGE
form.addEventListener("submit", async (event) => {
    event.preventDefault();
    const response = await post(new FormData(event.target));
    if (response.isRecorded) {
        AttendanceRecorded();
    } else {
        AttendanceNotRecorded();
    }

    document.querySelector("#inputField").value = "";
    // notify(isRecorded, "")

    // notify(isFetch, "")
});
// PREVENT THE FORM FROM SUBMITTING AND REDIRECTING TO A PAGE
form_auto.addEventListener("submit", async (event) => {
    event.preventDefault();
    let response = await post(new FormData(event.target));
    if (response.isRecorded) {
        AttendanceRecorded();
    } else {
        AttendanceNotRecorded();
    }
    document.querySelector("#inputField1").value = "";
    // notify(isRecorded, "")

    // notify(isFetch, "")
});
// LOAD THE TABLE => GET
async function get() {
    let uri = document.getElementById("getURI").value;
    let isFetch = false;
    const data = await axios.get(uri);

    return data;
}

// FOR NOTIFICATIONS ETC

function notify(status, content) {}

function error(status, content) {}

function AttendanceRecorded() {
    console.log("Student Attendance Recorded");
    Swal.fire({
        icon: "successful",
        title: "Student Attendance Recorded!",
        showConfirmButton: false,
        timer: 750,
    });
}

function AttendanceNotRecorded() {
    console.log("Student Attendance Not Recorded");
    Swal.fire({
        icon: "warning",
        title: "Student Attendance Not Recorded!",
        showConfirmButton: false,
        timer: 750,
    });
}
