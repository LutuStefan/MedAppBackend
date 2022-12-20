import { configureStore } from '@reduxjs/toolkit'
import signUpErrorsReducer from "./signUpErrorSlice";

export default configureStore({
    reducer: {
        signUpErrors: signUpErrorsReducer
    }
})
