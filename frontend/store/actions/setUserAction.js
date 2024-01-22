// file-location: proeject-folder/store/actions/setUserAction.js
export const setUser = (userData) => {
  return {
    type: 'SET_USER',
    payload: userData
  };
};