import {createStackNavigator} from '@react-navigation/stack';
import {NavigationContainer, DefaultTheme} from '@react-navigation/native';
import {useFonts} from "expo-font";

import store from "./src/redux/store";
import {Provider} from 'react-redux'

import Home from './src/screens/Home';
import Details from './src/screens/Details';
import SignUpScreen from "./src/screens/SignUpScreen";

const Stack = createStackNavigator();

const theme = {
    ...DefaultTheme,
    colors: {
        ...DefaultTheme.colors,
        background: "transparent"
    }
}

const App = () => {
    const [loaded] = useFonts({
        InterBold: require("../App/assets/fonts/Inter-Bold.ttf"),
        InterSemiBold: require('../App/assets/fonts/Inter-SemiBold.ttf'),
        InterMedium: require('../App/assets/fonts/Inter-Medium.ttf'),
        InterRegular: require('../App/assets/fonts/Inter-Regular.ttf'),
        InterLight: require('../App/assets/fonts/Inter-Light.ttf')
    });
    if (!loaded) return null;
    return (
        <NavigationContainer theme={theme}>
            <Provider store={store}>
                <Stack.Navigator screenOptions={{headerShown: false}}
                                 initialRouteName="SignUpScreen">
                    <Stack.Screen name='Home' component={Home}/>
                    <Stack.Screen name='Details' component={Details}/>
                    <Stack.Screen name='SignUpScreen' component={SignUpScreen}/>
                </Stack.Navigator>
            </Provider>
        </NavigationContainer>
    );
}

export default App