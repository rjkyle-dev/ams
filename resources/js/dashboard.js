import axios from "axios";

axios.defaults.baseURL = 'http://localhost/ams/public'
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


export function testStudentForm() {
    document.getElementById('s_rfid').value = "1023213";
}
