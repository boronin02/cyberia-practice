import { api } from "@/shared/api/axiosInstance";
import { ContactsResponse } from "./types";
import { useQuery } from "@tanstack/react-query";

export const fetchContacts = async (): Promise<ContactsResponse> => {
  const response = await api.get("/api/contacts");
  return response.data;
};

export const useContacts = () => {
  return useQuery({
    queryKey: ["contacts"],
    queryFn: fetchContacts,
  });
};
