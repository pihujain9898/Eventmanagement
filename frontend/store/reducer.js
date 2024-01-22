// file-location: proeject-folder/store/recuer.js


import { persistReducer } from 'redux-persist';
import storage from 'redux-persist/lib/storage'; // defaults to localStorage for web
const initState = {
    user: null,
};

const reducer = (state = initState, action) => {
    switch (action.type) {
        case 'SET_USER':
          return { ...state, user: action.payload };
        default:
          return state;
      }
}


const persistConfig = {
  key: 'root',
  storage,
  whitelist: ['user'] // only persist the 'user' state
};
const persistedReducer = persistReducer(persistConfig, reducer);

export default persistedReducer;