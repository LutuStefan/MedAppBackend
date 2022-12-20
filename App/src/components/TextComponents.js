import React from "react";
import {Text, TextInput, View} from "react-native";
import {FONTS, COLORS, SIZES, SHADOWS} from "../../constants";

export const Title = (props) => {
    return (
        <Text style={{
            fontSize: SIZES.extraLarge,
            fontFamily: FONTS.bold,
            color: COLORS.primary
        }}>{props.message}</Text>
    );
}

export const SubTitle = (props) => {
    return (
        <View style={{
            display: 'flex',
            width: '100%',
            alignItems: 'flex-start',

        }}>
            <Text style={{
                fontSize: SIZES.large,
                fontFamily: FONTS.semiBold,
                color: COLORS.primary
            }}>
                {props.message}
            </Text>
        </View>
    );
}

export const Input = ({setValue, value, keyboardType, placeholder, secureTextEntry, errorMessage, displayErrorMessage}) => {
    return (
        <View style={{
            width: '100%'
        }}>
            <TextInput style={{
                height: 50,
                marginVertical: 5,
                borderWidth: 1,
                borderRadius: SIZES.small,
                paddingLeft: 15
            }}
                       placeholder={placeholder}
                       keyboardType={keyboardType}
                       secureTextEntry={secureTextEntry}
                       value={value}
                       onChangeText={setValue}
            />
            {displayErrorMessage ?
                <Text style={{
                    color: 'orange',
                    paddingLeft: 15
                }}>{errorMessage}</Text>
                : null
            }
        </View>
    );
}