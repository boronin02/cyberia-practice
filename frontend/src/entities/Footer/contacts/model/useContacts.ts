import { fetchContacts } from "../api/contactsApi";
import { useQuery } from "@tanstack/react-query";

export const useContacts = () => {
  return useQuery({
    queryKey: ["contacts"],
    queryFn: fetchContacts,
  });
};
