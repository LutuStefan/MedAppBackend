import {View, SafeAreaView, Text, Image} from "react-native";
import {assets} from "../../constants";
import {FormButton} from '../components/Buttons'
import {SubTitle, Input} from "../components/TextComponents";
import {useState} from "react";
import {validateInput} from "../../constants/generalMethods";
import {useDispatch, useSelector} from "react-redux";
import { changeEmailError, changePasswordError, changeConfirmPasswordError } from "../redux/signUpErrorSlice";
import { message } from "../../constants/lang/en";

const SignUpScreen = () => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [confirmPassword, setConfirmPassword] = useState('');

    const errors = useSelector(state => state.signUpErrors.errors)
    const dispatch = useDispatch()

    const handlePress = () => {
        if(!validateInput(email, 'email')) {
            dispatch(changeEmailError(true))
        } else {
            dispatch(changeEmailError(false))
        }

        if(!validateInput(password, 'password')) {
            dispatch(changePasswordError(true))
        } else {
            dispatch(changePasswordError(false))
        }

        if(!validateInput([password, confirmPassword], 'confirmPassword')) {
            dispatch(changeConfirmPasswordError(true))
        } else {
            dispatch(changeConfirmPasswordError(false))
        }
    }

    return (
        <SafeAreaView style={{
            flex: 1,
            width: '100%',
            height: '100%',
            justifyContent: 'center',
            alignItems: 'center'
        }}>
            <View style={{
                flex: 1,
                backgroundColor: 'white',
                width: '85%'
            }}>
                <Image
                    source={assets.logo}
                    resizeMode="contain"
                    style={{
                        width: '100%',
                        height: '30%'
                    }}
                />
                <View style={{
                    flex: 1,
                    alignItems: "center",
                    width: '100%',
                    height: '70%',
                }}>
                    <SubTitle message={"Create your Account"}/>
                    <View style={{
                        width: '100%',
                        display: 'flex',
                        justifyContent: 'center',
                        alignItems: 'center',
                        marginTop: 15
                    }}>
                        <Input keyboardType={"email-address"}
                               placeholder={"Email"}
                               secureTextEntry={false}
                               value={email}
                               setValue={setEmail}
                               errorMessage={message.invalid_email}
                               displayErrorMessage={errors.emailError}
                        />

                        <Input placeholder={"Password"}
                               secureTextEntry={true}
                               value={password}
                               setValue={setPassword}
                               errorMessage={message.password_requirements}
                               displayErrorMessage={errors.passwordError}
                        />

                        <Input placeholder={"Confirm Password"}
                               secureTextEntry={true}
                               value={confirmPassword}
                               setValue={setConfirmPassword}
                               errorMessage={message.invalid_confirm_password}
                               displayErrorMessage={errors.confirmPasswordError}
                        />
                        <FormButton handlePress={handlePress} message={"Sign up"}/>
                    </View>
                </View>
            </View>
        </SafeAreaView>
    )
}

export default SignUpScreen