import {createContext, useState} from "react";

export const AuthContext = createContext(null);

export function AuthProvider({children}) {
    const [user, setUser] = useState(null);
    const [token, setToken] = useState(null);
    const [loading, setLoading] = useState(true);

    const login = async (credentials) => {
        const response = await login(credentials);
        setUser(response.data.user);
        setToken(response.data.token);
    }
}