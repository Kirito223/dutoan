import noticeApi from "../../api/noticeApi.js";
import { public_path } from "../../const/path.js";
window.onload = function() {
    let file = document.getElementsByClassName("downloadFile");
    for (const f of file) {
        f.onclick = function(e) {
            e.preventDefault();
            noticeApi.downloadFile(f.dataset.file);
        };
    }
};
