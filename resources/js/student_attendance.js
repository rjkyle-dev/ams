
console.log('Dev Console ------------ Attendance Page');

let attendanceStart = false;
if(attendanceStart){
    document.addEventListener("keydown", function(event) {
        event.preventDefault();
        event.stopPropagation();
    }, true);

    document.addEventListener("keyup", function(event) {
        event.preventDefault();
        event.stopPropagation();
    }, true);
}

