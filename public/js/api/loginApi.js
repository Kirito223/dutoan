import axios from "./axiosClient.js";
const loginApi = {
    login: async function(data) {
        let result = await axios.post("login", data);
        return result;
    }, 
    logout: async function(){
        let result = await axios.get("logout");
        return result;
    }
};
export default loginApi;