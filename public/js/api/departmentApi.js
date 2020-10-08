import axiosClient from "./axiosClient.js";
const departmentApi = {
    getData: async function(page) {
        if (page != undefined) {
            let result = await axiosClient.get(`department/all?page=${page}`);
            return result;
        } else {
            let result = await axiosClient.get(`department/all`);
            return result;
        }
    },
    save: async function(data) {
        let result = await axiosClient.post(``, data);
        return result;
    },
    edit: async function(data) {
        let result = await axiosClient.put(``, data);
        return result;
    },
    delete: async function(id) {
        let result = await axiosClient.delete(``, data);
        return result;
    }
};
export default departmentApi;
