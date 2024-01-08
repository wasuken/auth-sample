// src/App.js
import React, { useState } from "react";
import axios from "axios";

function App() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [token, setToken] = useState("");

  const handleLogin = async () => {
    try {
      const response = await axios.post("http://localhost:3003/api/login", {
        email,
        password,
      });
      console.log(response.data);
      setToken(response.data);
      localStorage.setItem("token", response.data);
    } catch (error) {
      console.error("Login failed:", error);
    }
  };

  const handleFetchData = async () => {
    try {
      const response = await axios.get("http://localhost:3003/api/", {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      console.log("Data:", response.data);
    } catch (error) {
      console.error("Fetching data failed:", error);
    }
  };

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
      <button onClick={handleFetchData}>Fetch Data</button>
    </div>
  );
}

export default App;
