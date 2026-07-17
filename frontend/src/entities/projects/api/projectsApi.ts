import { api } from "@/shared/api/axiosInstance";
import { ProjectsResponse, ProjectDetailResponse } from "./types";
import { useInfiniteQuery } from "@tanstack/react-query";

export const fetchProjects = async (pageNum: number): Promise<ProjectsResponse> => {
  const response = await api.get(`/api/projects?page=${pageNum}`);
  return response.data;
};

export const fetchProjectById = async (id: number): Promise<ProjectDetailResponse | null> => {
  try {
    const response = await api.get(`/projects/${id}`);
    return response.data;
  } catch {
    return null;
  }
};

export const useInfiniteProjects = () => {
  return useInfiniteQuery({
    queryKey: ["projects-infinite"],
    queryFn: ({ pageParam = "1" }) => fetchProjects(Number(pageParam)),
    initialPageParam: "1",
    getNextPageParam: (lastPage) => {
      const { page, last_page } = lastPage.data.pagination;
      return page < Number(last_page) ? String(page + 1) : undefined;
    },
  });
};
