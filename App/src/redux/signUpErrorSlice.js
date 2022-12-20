import { createSlice } from '@reduxjs/toolkit'

export const signUpErrorsSlice = createSlice({
    name: 'signUpErrors',
    // initialState: {
    //     emailError: false,
    //     passwordError: false,
    //     confirmPasswordError: false
    // },
    initialState: {
        errors: {
            emailError: false,
            passwordError: false,
            confirmPasswordError: false
        }
    },
    // reducers: {
    //     changeEmailError: state => {
    //         state.errorEmail = !state.errorEmail
    //     },
    //     changePasswordError: state => {
    //         state.passwordError = !state.passwordError
    //     },
    //     changeConfirmPasswordError: (state) => {
    //         state.confirmPasswordError = !state.confirmPasswordError
    //     }
    // }
    reducers: {
        changeEmailError: (state, action) => {
            state.errors.emailError = action.payload
        },
        changePasswordError: (state, action) => {
            state.errors.passwordError = action.payload
        },
        changeConfirmPasswordError: (state, action) => {
            state.errors.confirmPasswordError = action.payload
        }
    }
})

export const { changeEmailError, changePasswordError, changeConfirmPasswordError } = signUpErrorsSlice.actions

export default signUpErrorsSlice.reducer