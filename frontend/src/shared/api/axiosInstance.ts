import axios from "axios";
const isServer = typeof window === "undefined";

export const api = axios.create({
  baseURL: isServer
    ? process.env.API_URL || "http://localhost:8000"
    : process.env.NEXT_PUBLIC_API_URL || "",
  timeout: 10000,
  headers: {
    "Content-Type": "application/json",
  },
});
