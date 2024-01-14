import { useContext } from "react";
import { AuthContext } from "./AuthContext";
import axios from "axios";

const useAuth = () => {
  const { token, setToken } = useContext(AuthContext);

  const login = async (email: string, password: string) => {
    try {
      const response = await axios.post("http://localhost:3003/api/login", {
        email,
        password,
      });
      setToken(response.data);
    } catch (error) {
      console.error("Login failed:", error);
    }
  };

  const logout = () => {
    setToken("");
    localStorage.removeItem("token");
  };

  const isTokenExpired = (token) => {
    if (!token) {
      return true;
    }

    const payload = JSON.parse(atob(token.split(".")[1]));
    const iat = payload.iat;
    const currentTime = Math.floor(Date.now() / 1000);

    return currentTime > iat;
  };

  return { token, login, logout, isTokenExpired };
};

export default useAuth;
