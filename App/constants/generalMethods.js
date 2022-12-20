import {message} from "./lang/en";

export const validateInput = (value, type) => {
    switch(type) {
        case 'email':
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)) return true;
            return false;
        case 'password':
            let passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
            if(value.match(passw)) return true;
            return false;
        case 'confirmPassword':
            let password, confirmPassword;
             [password, confirmPassword] = value;

             if(password !== confirmPassword || password === "") return false;
             return true;
    }
}