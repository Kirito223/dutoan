import axiosClient from "./axiosClient.js";
const accountApi = {
    getData: async function(page, id) {
        let result = await axiosClient.get(`account/all/${id}?page=${page}`);
        return result;
    },

    save: async function(data) {
        let result = await axiosClient.post(`account/store`, data);
        return result;
    },
    edit: async function(data, id) {
        let result = await axiosClient.put(`account/update/${id}`, data);
        return result;
    },
    delete: async function(id) {
        let result = await axiosClient.delete(`account/destroy/${id}`);
        return result;
    },
};
export default accountApi;
