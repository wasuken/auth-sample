import React, { useState, useContext } from "react";
import axios from "axios";
import { AuthContext } from "./AuthContext";

function App() {
  const [email, setEmail] = useState<string>("");
  const [password, setPassword] = useState<string>("");
  const { token, setToken } = useContext(AuthContext);

  const handleLogin = async () => {
    try {
      const response = await axios.post("http://localhost:3003/api/login", {
        email,
        password,
      });
      console.log(response.data);
      setToken(response.data);
    } catch (error) {
      console.error("Login failed:", error);
    }
  };

  const handleFetchData = async () => {
    try {
      const response = await axios.get("http://localhost:3003/api/", {
        headers: { Authorization: `Bearer ${token}` },
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
