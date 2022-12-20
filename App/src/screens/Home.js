import { View, SafeAreaView, Text } from "react-native";
import {FocusedStatusBar} from "../components";
import {COLORS} from "../../constants";

const Home = () => {
    return (
        <SafeAreaView style={{ flex: 1 }}>
            <View style={{
                flex: 1,
                justifyContent: "center",
                alignItems: "center",
                backgroundColor: 'red',
                width: '100%',
                height: '100%'
            }}>
                <FocusedStatusBar
                    barStyle="dark-content"
                    backgroundColor={COLORS.secondary}
                />

                <Text>Home Screen</Text>
            </View>
        </SafeAreaView>
    )
}

export default Home