import {Text, TouchableOpacity} from "react-native";
import React from "react";
import {COLORS, SIZES, FONTS, SHADOWS} from "../../constants";

export const FormButton = ({message, handlePress, ...props}) => {
    return (
        <TouchableOpacity style={{
            width: 300,
            height: 50,
            backgroundColor: COLORS.primary,
            borderRadius: SIZES.small,
            alignItems: 'center',
            justifyContent: 'center',
            marginVertical: 15,
            ...SHADOWS.light,
            ...props
        }}
                          onPress={handlePress}>
            <Text style={{
                color: COLORS.white,
                fontFamily: FONTS.bold,
                fontSize: SIZES.medium
            }}>{message}</Text>
        </TouchableOpacity>
    )
}