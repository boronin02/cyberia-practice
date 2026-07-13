import { api } from "@/shared/api/axiosInstance";
import { ProjectResponse } from "./types";
import { useInfiniteQuery } from "@tanstack/react-query";

export const fetchProjects = async (pageNum: number): Promise<ProjectResponse> => {
  const response = await api.get(`/api/projects?page=${pageNum}`);
  return response.data;
};

export const useInfiniteProjects = () => {
  return useInfiniteQuery({
    queryKey: ["projects-infinite"],
    queryFn: ({ pageParam = "1" }) => fetchProjects(Number(pageParam)),
    initialPageParam: "1",
    getNextPageParam: (lastPage) => {
      const { page, last_page } = lastPage.data.pagination;
      return page < last_page ? page + 1 : undefined;
    },
  });
};
