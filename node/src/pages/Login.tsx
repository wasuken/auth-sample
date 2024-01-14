import React, { useState, useContext } from "react";
import axios from "axios";
import { AuthContext } from "@/AuthContext";
import useAuth from "@/useAuth";
import { Navigate } from "react-router-dom";

function Login() {
  const [email, setEmail] = useState<string>("");
  const [password, setPassword] = useState<string>("");
  const { login, isLogin } = useAuth();

  const handleLogin = async () => {
    try {
      login(email, password);
    } catch (error) {
      console.error("Login failed:", error);
    }
  };

  if (isLogin) {
    return <Navigate to="/" />;
  }

  return (
    <div>
      <input
        type="email"
        value={email}
        onChange={(e) => setEmail(e.target.value)}
        placeholder="Email"
      />
      <input
        type="password"
        value={password}
        onChange={(e) => setPassword(e.target.value)}
        placeholder="Password"
      />
      <button onClick={handleLogin}>Login</button>
    </div>
  );
}

export default Login;
