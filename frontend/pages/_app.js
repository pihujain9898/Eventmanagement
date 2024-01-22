import '@/styles/globals.css'
import { PersistGate } from 'redux-persist/integration/react';
import { Provider } from "react-redux";
import { createStore } from 'redux';
import persistedReducer  from "../store/reducer";
import { persistStore } from 'redux-persist';


const store = createStore(persistedReducer);
const persistor = persistStore(store);

// persistor.subscribe(() => {
//   console.log(persistor.getState());
// });


export default function App({ Component, pageProps }) {
  return (
    <Provider  store={store}>
      <PersistGate loading={null} persistor={persistor}>
        <Component {...pageProps} />
      </PersistGate>
    </Provider>
  )
}