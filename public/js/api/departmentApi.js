import axiosClient from "./axiosClient.js";
const departmentApi = {
    getData: async function(page) {
        let result = await axiosClient.get(`department/all`);
        return result;
    },
    fetchDataWithoutTree: async function() {
        let result = await axiosClient.get(`department/all?all=1`);
        return result;
    },
    save: async function(data) {
        let result = await axiosClient.post(`department/store`, data);
        return result;
    },
    edit: async function(data, id) {
        let result = await axiosClient.put(`department/update/${id}`, data);
        return result;
    },
    delete: async function(id) {
        let result = await axiosClient.delete(`department/destroy/${id}`);
        return result;
    },
    changePassword: async function(data) {
        let result = await axiosClient.post("department/changePassword", data);
        return result;
    },
    getInfoAccount: async function(id) {
        let result = await axiosClient.get("department/getAccount/" + id);
        return result;
    }
};
export default departmentApi;
