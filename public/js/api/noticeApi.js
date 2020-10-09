import axios from "./axiosClient.js";
const noticeApi = {
    fetch: async function(page) {
        let result = await axios.get("notice/all?page=" + page);
        return result.data;
    },
    save: async function(data) {
        let result = await axios.post("notice/store", data);
        return result;
    },
    edit: async function(data, id) {
        let result = await axios.post("notice/update/" + id, data);
        return result;
    },
    del: async function(id) {
        let result = await axios.delete("notice/destroy/" + id);
        return result;
    }
};

export default noticeApi;
